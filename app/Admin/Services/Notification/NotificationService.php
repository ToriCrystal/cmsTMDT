<?php

namespace App\Admin\Services\Notification;

use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Admin\Repositories\Store\StoreRepositoryInterface;
use App\Admin\Repositories\User\UserRepositoryInterface;
use App\Enums\Notification\NotificationStatus;
use App\Traits\NotifiesViaFirebase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationService implements NotificationServiceInterface
{
    use NotifiesViaFirebase;

    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;
    private UserRepositoryInterface $userRepository;
    private AdminRepositoryInterface $adminRepository;

    private StoreRepositoryInterface $storeRepository;

    public function __construct(NotificationRepositoryInterface $repository,
                                AdminRepositoryInterface        $adminRepository,
                                StoreRepositoryInterface        $storeRepository,
                                UserRepositoryInterface         $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;
        $this->storeRepository = $storeRepository;
    }

    public function store(Request $request)
    {
        $data = $request->validated();

        $notification = $this->repository->create($data);
        $device_token = $notification->user->device_token;

        if ($notification && $device_token) {
            $deviceTokens = [$device_token];
            $this->sendFirebaseNotification($deviceTokens, null, $notification->title, $notification->message);
        }

        return $notification;
    }


    public function update(Request $request): object|bool
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);
    }

    /**
     * @throws \Exception
     */
    public function delete($id): object|bool
    {
        return $this->repository->delete($id);
    }

    /**
     * @throws \Exception
     */
    public function updateDeviceToken($request): JsonResponse
    {
        $data = $request->validate([
            'admin_id' => 'sometimes|required_without:store_id|exists:admins,id',
            'store_id' => 'sometimes|required_without:user_id|exists:stores,id',
            'device_token' => 'required|string'
        ]);

        $entity = null;
        $repository = null;

        if (!empty($data['admin_id'])) {
            $entity = $this->adminRepository->findOrFail($data['admin_id']);
            $repository = $this->adminRepository;
        } elseif (!empty($data['store_id'])) {
            $entity = $this->storeRepository->findOrFail($data['store_id']);
            $repository = $this->storeRepository;
        }

        if (!$entity) {
            return response()->json(['message' => 'Entity not found.'], 404);
        }

        if ($entity->device_token === $data['device_token'] && $entity->device_token_updated_at->gt(now()->subDay())) {
            return response()->json(['message' => 'Token is up-to-date, no need to update.'], 200);
        }

        try {
            $repository->update($entity->id, [
                'device_token' => $data['device_token'],
                'device_token_updated_at' => now()
            ]);
            // Optionally, register the device token to a topic
            // $this->registerDeviceToTopic($data['device_token'], "Notification");

            return response()->json(['message' => 'Token successfully stored.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to store token.', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Gets notifications for admin
     *
     * @param Request $request
     * @return mixed
     */
    public function getNotifications(Request $request): mixed
    {
        $data = $request->validated();
        return $this->repository->getNotificationsByField('admin_id', $data['admin_id'], 20);
    }

    /**
     * Gets notifications for store
     *
     * @param Request $request
     * @return mixed
     */
    public function getNotificationsForStore(Request $request): mixed
    {
        $data = $request->validated();
        return $this->repository->getNotificationsByField('store_id', $data['store_id'], 20);
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $data = $request->validated();

        $filters = [];
        if (!empty($data['admin_id'])) {
            $filters['admin_id'] = $data['admin_id'];
        }
        if (!empty($data['store_id'])) {
            $filters['store_id'] = $data['store_id'];
        }

        $notifications = $this->repository->getBy($filters);

        foreach ($notifications as $notification) {
            $this->repository->updateAttribute($notification->id, 'status', NotificationStatus::READ);
        }

        return response()->json(['success' => "Updated successfully"]);
    }


}
