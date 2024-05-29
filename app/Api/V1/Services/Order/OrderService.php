<?php

namespace App\Api\V1\Services\Order;

use App\Api\V1\Repositories\Admin\AdminRepositoryInterface;
use App\Api\V1\Repositories\Area\AreaRepositoryInterface;
use App\Api\V1\Repositories\CartItem\CartItemRepositoryInterface;
use App\Api\V1\Repositories\DriverTransaction\TransactionRepositoryInterface;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Api\V1\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Api\V1\Repositories\Setting\SettingRepositoryInterface;
use App\Api\V1\Repositories\Store\StoreRepositoryInterface;
use App\Api\V1\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Enums\Driver\AutoAccept;
use App\Enums\Driver\DriverStatus;
use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;
use App\Traits\HandlesNotifications;
use App\Traits\NotifiesViaFirebase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService implements OrderServiceInterface
{
    use NotifiesViaFirebase, HandlesNotifications;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;

    private StoreRepositoryInterface $storeRepository;
    private UserDriverRepositoryInterface $userDriverRepository;
    private CartItemRepositoryInterface $cartItemRepository;
    private OrderItemRepositoryInterface $orderItemRepository;
    private AdminRepositoryInterface $adminRepository;
    private NotificationRepositoryInterface $notificationRepository;
    private AreaRepositoryInterface $areaRepository;
    private SettingRepositoryInterface $settingRepository;

    private TransactionRepositoryInterface $transactionRepository;


    public function __construct(OrderRepositoryInterface        $repository,
                                UserDriverRepositoryInterface   $userDriverRepository,
                                CartItemRepositoryInterface     $cartItemRepository,
                                OrderItemRepositoryInterface    $orderItemRepository,
                                AdminRepositoryInterface        $adminRepository,
                                NotificationRepositoryInterface $notificationRepository,
                                SettingRepositoryInterface      $settingRepository,
                                TransactionRepositoryInterface  $transactionRepository,
                                StoreRepositoryInterface        $storeRepository)
    {
        $this->repository = $repository;
        $this->storeRepository = $storeRepository;
        $this->userDriverRepository = $userDriverRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->adminRepository = $adminRepository;
        $this->notificationRepository = $notificationRepository;
        $this->settingRepository = $settingRepository;
        $this->transactionRepository = $transactionRepository;
    }


    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $systemCommissionRate = $this->settingRepository
                ->getBy(['setting_key' => 'system_commission_rate']);
            $data['code'] = uniqid_real();
            $sub_total = $data['sub_total'];
            $data['system_revenue'] = $systemCommissionRate[0]->plain_value * $sub_total;
            $store = $this->storeRepository->findOrFail($data['store_id']);
            $data['destination_address'] = $store->address;
            $data['status'] = OrderStatus::PendingStoreConfirmation;
            $data['payment_method'] = PaymentMethod::Direct;
            $data['lat'] = $data['coordinates']['lat'];
            $data['lng'] = $data['coordinates']['lng'];
            unset($data['coordinates']);

            $order = $this->repository->create($data);

            // Lấy thông tin sản phẩm từ cart_ids và tạo các mục đơn hàng
            $this->createOrderItems($order, $data['cart_ids']);

            // Tạo thông báo và gửi thông báo
            $title = config('notifications.new_order.title') . " " . $order->id;
            $body = config('notifications.new_order.message');

            $this->createNotificationsForAdmins($order);
            $this->createNotificationsForStore($order);
            $this->sendNotificationsToAdmins($title, $body);
            $this->sendNotificationsToStores([$store->id], $title, $body);

            // Xoá cart item
//            $this->deleteSelectedCartItems($data['cart_ids']);
            DB::commit();

            return $order;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    protected function createNotificationsForAdmins($order): void
    {
        $admins = $this->adminRepository->getAll();
        foreach ($admins as $admin) {
            $this->createNotification($admin, $order, 'admin_id', 'new_order');
        }
    }

    /**
     * @throws Exception
     */
    protected function createNotificationsForStore($order): void
    {
        $store = $this->storeRepository->findOrFail($order->store_id);
        $this->createNotification($store, $order, 'store_id', 'new_order');

    }


    /**
     * @throws Exception
     */
    protected function deleteSelectedCartItems($cartItemIds): void
    {
        foreach ($cartItemIds as $cartItemId) {
            $this->cartItemRepository->delete($cartItemId);
        }
    }


    /**
     * @throws Exception
     */
    protected function createOrderItems($order, $cartItemIds): void
    {
        $cartItems = $this->cartItemRepository->getCartItemsByIds($cartItemIds);

        foreach ($cartItems as $item) {
            $orderItem = [
                'unit_price' => $order->sub_total,
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty
            ];
            $this->orderItemRepository->create($orderItem);
        }
    }


    public function update(Request $request)
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);

    }

    public function getInstance()
    {
        return $this->instance;
    }

    private function notifyCustomer($order, $entityType, $notificationType): void
    {
        $customerDeviceToken = $order->customer->device_token;
        if ($customerDeviceToken) {
            $this->sendFirebaseNotification(
                [$customerDeviceToken],
                null,
                config('notifications.' . $notificationType . '.title'),
                config('notifications.' . $notificationType . '.message')
            );
            $this->createNotificationData(
                $entityType == 'driver_id' ? $order->driver : $order->customer,
                $order,
                $entityType,
                $notificationType
            );
        }
    }

    private function updateDriverStatus($order, $status): void
    {
        $this->userDriverRepository->updateAttribute(
            $order->driver_id,
            'order_accepted',
            $status
        );
    }

    public function confirmOrder($order): bool
    {
        $this->notifyCustomer($order, 'user_id', 'order_confirmed');
        $this->updateDriverStatus($order, DriverStatus::Received);
        return true;
    }

    public function inTransitOrder($order): bool
    {
        $this->notifyCustomer($order, 'user_id', 'order_in_transit');
        $this->updateDriverStatus($order, DriverStatus::InTransit);
        return true;
    }

    public function arrivedAtStore($order): bool
    {
        $this->notifyCustomer($order, 'user_id', 'order_arrived_at_store');
        return true;
    }

    public function movingToDestination($order): bool
    {
        $this->notifyCustomer($order, 'user_id', 'order_moving_to_destination');
        return true;
    }

    /**
     * @throws Exception
     */
    public function completedOrder($order): bool
    {
        $this->notifyCustomer($order, 'user_id', 'order_completed');
        $this->updateDriverStatus($order, DriverStatus::NotReceived);
        $this->transactionRepository->create(
            [
                "order_id" => $order->id,
                "driver_id" => $order->driver_id
            ]
        );
        return true;
    }

    /**
     * @throws Exception
     */
    public function cancelledOrder($order): bool
    {
        $this->updateDriverStatus($order, DriverStatus::NotReceived);
        $newDriverId = $this->assignDriver($order->store, $order, $order->driver_id);
        if ($newDriverId) {
            $this->repository->update($order->id, [
                'driver_id' => $newDriverId,
                'status' => OrderStatus::PendingDriverConfirmation
            ]);

        }

        return true;
    }

    protected function assignDriver($store, $order, $excludedDriverId = null)
    {
        $driversQuery = [
            'auto_accept' => AutoAccept::Auto,
            'order_accepted' => DriverStatus::NotReceived
        ];

        $drivers = $this->userDriverRepository->getBy($driversQuery);

        if ($excludedDriverId) {
            $drivers = $drivers->where('id', '!=', $excludedDriverId);
        }

        $closestDriver = find_closest_driver($store->lat, $store->lng, $drivers);

        if ($closestDriver) {
            $this->userDriverRepository->updateAttribute($closestDriver->id, 'order_accepted', DriverStatus::PendingConfirmation);
            $this->sendFirebaseNotification(
                [$closestDriver->user->device_token],
                null,
                config('notifications.new_order.title'),
                config('notifications.new_order.message')
            );
            $this->createNotification($closestDriver, $order, 'driver_id', 'new_order');
            return $closestDriver->id;
        }
        return null;
    }


    public function updateStatus(Request $request): bool
    {
        try {
            $data = $request->validated();
            $status = $data['status'];
            $order = $this->repository->findOrFail($data['id']);

            switch ($status) {
                case OrderStatus::PendingStoreConfirmation->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::PendingStoreConfirmation);
                    break;
                case OrderStatus::PendingDriverConfirmation->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::PendingDriverConfirmation);
                    break;
                case OrderStatus::Confirmed->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::Confirmed);
                    $this->confirmOrder($order);
                    break;
                case OrderStatus::InTransit->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::InTransit);
                    $this->inTransitOrder($order);
                    break;
                case OrderStatus::ArrivedAtStore->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::ArrivedAtStore);
                    $this->arrivedAtStore($order);
                    break;
                case OrderStatus::MovingToDestination->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::MovingToDestination);
                    $this->movingToDestination($order);
                    break;
                case OrderStatus::Completed->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::Completed);
                    $this->repository->updateAttribute($data['id'], 'completed_at', now());                    $this->completedOrder($order);
                    break;
                case OrderStatus::Cancelled->value:
//                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::Cancelled);
                    $this->cancelledOrder($order);
                    break;
                case OrderStatus::Failed->value:
                    $this->repository->updateAttribute($data['id'], 'status', OrderStatus::Failed);
                    break;
                default:

                    return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getOrderByDriver($userId, $limit, $page)
    {
        return $this->repository->getByQueryBuilder(['customer_id' => $userId])
            ->paginate($limit, ['*'], 'page', $page);
    }
}
