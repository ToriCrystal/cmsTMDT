<?php

namespace App\Console\Commands;

use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Admin\Services\Order\OrderServiceInterface;
use App\Enums\Driver\AutoAccept;
use App\Traits\HandlesNotifications;
use App\Traits\NotifiesViaFirebase;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TransactionsReportSchedule extends Command
{
    use NotifiesViaFirebase, HandlesNotifications;

    protected OrderServiceInterface $orderService;

    protected UserDriverRepositoryInterface $userDriverRepository;

    protected NotificationRepositoryInterface $notificationRepository;


    public function __construct(OrderServiceInterface           $orderService,
                                NotificationRepositoryInterface $notificationRepository,
                                UserDriverRepositoryInterface   $userDriverRepository)
    {
        parent::__construct();

        $this->orderService = $orderService;
        $this->userDriverRepository = $userDriverRepository;
        $this->notificationRepository = $notificationRepository;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drivers:check-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if drivers have made their payments on time and notifies them if not.';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        Log::info("Check payment driver.");
        $lateOrderNotification = config('notifications.late_order');
        $lockedAutoAcceptNotification = config('notifications.locked_auto_accept');
        $twoDays = 2 * 24 * 60;
        $lateTwoDayOrders = $this->orderService->getLateOrders($twoDays);
        $threeDays = 3 * 24 * 60;
        $lateThreeDayOrders = $this->orderService->getLateOrders($threeDays);

        if ($lateTwoDayOrders->isNotEmpty()) {
            foreach ($lateTwoDayOrders as $order) {
                $driver = $this->userDriverRepository->findOrFail($order->driver_id);
                $deviceTokens = [$driver->user->device_token];
                $message = str_replace('#ORDER_ID#', $order->id, $lateOrderNotification['message']);

                $this->sendFirebaseNotification($deviceTokens, null, $lateOrderNotification['title'], $message);

                $this->notificationRepository->create([
                    "user_id" => $driver->id,
                    "title" => $lateOrderNotification['title'],
                    "message" => $message,
                    "order_id" => $order->id,
                    "type" => "late_order"
                ]);
            }
        }

        if ($lateThreeDayOrders->isNotEmpty()) {
            foreach ($lateThreeDayOrders as $order) {
                $driver = $this->userDriverRepository->findOrFail($order->driver_id);
                $this->userDriverRepository->updateAttribute($driver->id, 'auto_accept', AutoAccept::Locked);
                $this->userDriverRepository->updateAttribute($driver->id, 'auto_accept', AutoAccept::Locked);

                $deviceTokens = [$driver->user->device_token];
                $message = $lockedAutoAcceptNotification['message'];
                $this->sendFirebaseNotification($deviceTokens, null, $lockedAutoAcceptNotification['title'], $message);
                $this->notificationRepository->create([
                    "user_id" => $driver->id,
                    "title" => $lockedAutoAcceptNotification['title'],
                    "message" => $message,
                    "order_id" => $order->id,
                    "type" => "locked_auto_accept"
                ]);
                Log::info("Lock auto accept driver");
            }
        }


        return Command::SUCCESS;
    }

}
