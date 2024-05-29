<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Rates;
use App\Events\OrderStatusUpdated;
use App\Enums\Order\OrderStatus;

class UpdateOrderCompletionRate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderStatusUpdated $event)
{
    $driverId = $event->order->driver_id;

    // Đếm số lượng đơn hàng cho mỗi trạng thái
    $totalOrders = \App\Models\Order::where('driver_id', $driverId)->count();
    $completedOrders = \App\Models\Order::where('driver_id', $driverId)->where('status', OrderStatus::Completed)->count();
    $acceptOrders = \App\Models\Order::where('driver_id', $driverId)->where('status', OrderStatus::PendingDriverConfirmation)->count();
    $cancelledOrders = \App\Models\Order::where('driver_id', $driverId)->where('status', OrderStatus::Cancelled)->count();

    // Tính phần trăm đơn hàng tài xế nhận
    $totaltanceRate = ($totalOrders > 0) ? ($acceptOrders / $totalOrders) * 100 : 0;
    $acceptanceRate = 100-$totaltanceRate;

    // Tính phần trăm đơn hàng tài xế hoàn thành
    $completionRate = ($totalOrders > 0) ? ($completedOrders / $totalOrders) * 100 : 0;

    // Tính phần trăm đơn hàng tài xế hủy
    $cancellationRate = ($totalOrders > 0) ? ($cancelledOrders / $totalOrders) * 100 : 0;

    // Cập nhật giá trị mới vào cột order_acceptance_rate của bảng Rates
    Rates::where('user_id', $driverId)->update(['order_acceptance_rate' => $acceptanceRate]);

    // Cập nhật giá trị mới vào cột order_completion_rate của bảng Rates
    Rates::where('user_id', $driverId)->update(['order_completion_rate' => $completionRate]);

    // Cập nhật giá trị mới vào cột order_cancellation_rate của bảng Rates
    Rates::where('user_id', $driverId)->update(['order_cancellation_rate' => $cancellationRate]);
}
}
