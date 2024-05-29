<?php

use App\Enums\Admin\AdminRoles;
use App\Enums\Area\AreaStatus;
use App\Enums\DefaultStatus;
use App\Enums\Driver\AutoAccept;
use App\Enums\Driver\DriverAssignmentType;
use App\Enums\Driver\DriverStatus;
use App\Enums\Driver\DriverTransactionStatus;
use App\Enums\Gender;
use App\Enums\Order\OrderStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Product\StockStatus;
use App\Enums\Shipping\ShippingMethod;
use App\Enums\Store\StoreStatus;
use App\Enums\User\UserRole;
use App\Enums\Product\Type;
use App\Enums\Product\Obligatory;
use App\Enums\DiscountType;
use App\Enums\Notification\NotificationStatus;

return [
    AdminRoles::class => [
        AdminRoles::SuperAdmin->value => 'Dev',
        AdminRoles::Admin->value => 'Admin',
    ],
    Gender::class => [
        Gender::Male->value => 'Nam',
        Gender::Female->value => 'Nữ',
        Gender::Other->value => 'Khác',
    ],
   AutoAccept::class => [
       AutoAccept::Auto->value => 'Tự động nhận chuyến',
       AutoAccept::Off->value => 'Tắt tự động nhận chuyến',
       AutoAccept::Locked->value => 'Khoá tự động nhận chuyến',
    ],
    UserRole::class => [
        UserRole::Customer->value => 'Khách hàng',
        UserRole::Driver->value => 'Tài xế',
    ],
    DriverTransactionStatus::class => [
        DriverTransactionStatus::Pending->value => 'Chưa chuyển khoản',
        DriverTransactionStatus::Success->value => 'Đã chuyển',
        DriverTransactionStatus::Late->value => 'Chuyển muộn',
    ],
    DriverAssignmentType::class => [
        DriverAssignmentType::Auto->value => 'Tự động',
        DriverAssignmentType::Manual->value => 'Thủ công',
    ],
    DriverStatus::class => [
        DriverStatus::NotReceived->value => 'Đang chờ đơn',
        DriverStatus::Received->value => 'Đã nhận đơn',
        DriverStatus::InTransit->value => 'Đang chuyển đơn',
        DriverStatus::PendingConfirmation->value => 'Đang chờ xác nhận đơn',
    ],
    StockStatus::class => [
        StockStatus::InStock->value => 'Còn hàng',
        StockStatus::OutOfStock->value => 'Hết hàng',
    ],
    PaymentMethod::class => [
        PaymentMethod::Online->value => 'Online',
        PaymentMethod::Direct->value => 'Trực tiếp',
    ],

    ShippingMethod::class => [
        ShippingMethod::Standard->value => 'Tiêu chuẩn',
        ShippingMethod::Overnight->value => 'Nhanh',
    ],
    OrderStatus::class => [
        OrderStatus::PendingStoreConfirmation->value => 'Chờ cửa hàng xác nhận',
        OrderStatus::PendingDriverConfirmation->value => 'Chờ tài xế xác nhận',
        OrderStatus::Confirmed->value => ' Đã xác nhận',
        OrderStatus::InTransit->value => 'Đang di chuyển',
        OrderStatus::ArrivedAtStore->value => 'Đã đến cửa hàng',
        OrderStatus::MovingToDestination->value => 'Đang di chuyển đến điểm đến',
        OrderStatus::Completed->value => 'Hoàn thành',
        OrderStatus::Cancelled->value => 'Hủy bỏ',
        OrderStatus::Failed->value => 'Không thành công',
        OrderStatus::DriverUnavailable->value => 'Không tìm thấy tài xế',
    ],
    DefaultStatus::class => [
        DefaultStatus::Published->value => 'Đã xuất bản',
        DefaultStatus::Draft->value => 'Bản nháp'
    ],
    StoreStatus::class => [
        StoreStatus::Open->value => 'Mở cửa',
        StoreStatus::Close->value => 'Đóng cửa',
    ],
    Type::class => [
        Type::One->value => 'Chọn 1',
        Type::Many->value => 'Chọn nhiều',
    ],
    Obligatory::class => [
        Obligatory::Obligatory->value => 'Bắt buộc',
        Obligatory::NoObligatory->value => 'Không bắt buộc',
    ],
    DiscountType::class => [
        DiscountType::Money->value => 'Tiền Mặt',
        DiscountType::Percent->value => 'Phần Trăm',
    ],
    NotificationStatus::class => [
        NotificationStatus::NOT_READ->value => 'Chưa xem',
        NotificationStatus::READ->value => 'Đã xem',
    ],
    AreaStatus::class => [
        AreaStatus::On->value => 'Hoạt động',
        AreaStatus::Off->value => 'Không hoạt động',
    ],
];
