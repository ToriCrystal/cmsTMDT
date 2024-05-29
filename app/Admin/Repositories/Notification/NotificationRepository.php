<?php

namespace App\Admin\Repositories\Notification;

use App\Admin\Repositories\EloquentRepository;
use App\Enums\Notification\NotificationStatus;
use App\Models\Notification;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{

    public function getModel(): string
    {
        return Notification::class;
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10)
    {
        // TODO: Implement searchAllLimit() method.
    }

    /**
     * Retrieve a limited list of notifications by a specific field and value.
     *
     * @param string $field The field to filter by.
     * @param mixed $value The value to filter by.
     * @param int $limit Result limit.
     * @return mixed
     */
    public function getNotificationsByField($field, $value, $limit = 10): mixed
    {
        return $this->model
            ->where($field, $value)
            ->where('status', NotificationStatus::NOT_READ)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function getByAdminId($adminId, $limit = 10)
    {
        return $this->model
            ->where('admin_id', $adminId)
            ->where('status', NotificationStatus::NOT_READ)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function getByStoreId($storeId, $limit = 10)
    {
        return $this->model
            ->where('store_id', $storeId)
            ->where('status', NotificationStatus::NOT_READ)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }
}
