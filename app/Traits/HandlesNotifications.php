<?php

namespace App\Traits;

use App\Admin\Repositories\Notification\NotificationRepositoryInterface;
use App\Enums\Notification\NotificationStatus;
use App\Models\Order;

trait HandlesNotifications
{
    /**
     * Create and save a new notification in the database.
     * @param string $type Type of notification (new_order, order_cancelled, etc.)
     */
    public function createNotification($entity, $order, $entityType, string $type): void
    {
        $notificationRepository = app(NotificationRepositoryInterface::class);
        $notificationData = $this->createNotificationData($entity, $order, $entityType, $type);

        $notificationRepository->create($notificationData);
    }

    public function createNotificationData($entity, $order, $entityType, $type): array
    {
        $title = config("notifications.{$type}.title");
        $message = $this->formatNotificationMessage($order, config("notifications.{$type}.message"));

        return [
            'user_id' => $order->customer_id,
            $entityType => $entity->id,
            'title' => $title,
            'message' => $message,
            'type' => Order::class,
            'status' => NotificationStatus::NOT_READ,
        ];
    }

    /**
     * Format the notification message with a dynamic prefix.
     */
    public function formatNotificationMessage($order, $prefixMessage): string
    {
        return $prefixMessage . " " . $order->customer->fullname;
    }
}
