<?php

return [
    'store' => [
        'priority' => [
            'title' => 'priority',
            'orderable' => true
        ],
        'store_name' => [
            'title' => 'storeName',
            'orderable' => false
        ],
        'category_id' => [
            'title' => 'category2',
            'orderable' => false
        ],
        'area_id' => [
            'title' => 'area',
            'orderable' => false
        ],
        'open_hours_1' => [
            'title' => 'operatingTime',
            'orderable' => false,
            'visible' => false
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false
        ],
        'address_detail' => [
            'title' => 'address',
            'orderable' => false
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'store_category' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'position' => [
            'title' => 'position',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'area' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'position' => [
            'title' => 'position',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'product' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'order' => [
        'code' => [
            'title' => 'orderCode',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'customer_id' => [
            'title' => 'customer',
            'addClass' => 'align-middle',
            'orderable' => false,
            'visible' => false

        ],
        'driver_id' => [
            'title' => 'driver',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle'
        ],
        'payment_method' => [
            'title' => 'payment',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'shipping_method' => [
            'title' => 'shipping',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'shipping_address' => [
            'title' => 'shipping_address',
            'orderable' => false,
            'visible' => false
        ],

        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'transport_fee' => [
            'title' => 'transport_fee',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'total' => [
            'title' => 'total',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'slider' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'plain_key' => [
            'title' => 'keyIdentity',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'items' => [
            'title' => 'sliderItem',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'slider_item' => [
        'title' => [
            'title' => 'title',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'image' => [
            'title' => 'image',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'position' => [
            'title' => 'position',
            'orderable' => false,
            'width' => '150px',
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'page' => [
        'title' => [
            'title' => 'title',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'Rates' => [
        'user_id' => [
            'title' => 'ID Tài xế',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'order_acceptance_rate' => [
            'title' => 'Nhận đơn',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'order_completion_rate' => [
            'title' => 'Hoàn thành đơn',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'order_cancellation_rate' => [
            'title' => 'Hủy đơn',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
    ],
    'tag' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    /// thông báo
    'notifications' => [
        // 'checkbox' => [
        //     'title' => 'checkbox',
        //     'orderable' => false,
        //     'exportable' => false,
        //     'printable' => false,
        //     'addClass' => 'text-center',
        // ],
        'title' => [
            'title' => 'Tiêu đề',
            'orderable' => false,
        ],
        'user_id' => [
            'title' => 'Người nhận',
            'orderable' => false,
        ],
        'message' => [
            'title' => 'Nội dung',
            'orderable' => false,
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle',
        ],

        'created_at' => [
            'title' => 'Ngày thông báo',
            'orderable' => false,
            // 'visible' => false,
            'addClass' => 'align-middle',
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle',
        ],

    ],
    'category' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'post' => [
        'checkbox' => [
            'title' => 'choose',
            'orderable' => false,
            'addClass' => 'text-center',
            'width' => '10px',
            'footer' => '<input type="checkbox" class="check-all" />',
        ],
        'feature_image' => [
            'title' => 'image',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'title' => [
            'title' => 'title',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'categories' => [
            'title' => 'category',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'admin' => [
        'DT_RowIndex' => [
            'title' => 'serial',
            'width' => '20px',
            'orderable' => false
        ],
        'fullname' => [
            'title' => 'fullname',
            'orderable' => false
        ],
        'phone' => [
            'title' => 'phone',
            'orderable' => false
        ],
        'email' => [
            'title' => 'email',
            'orderable' => false,
        ],
        'roles' => [
            'title' => 'role',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'transaction' => [
        'id' => [
            'title' => 'STT',
            'orderable' => false
        ],
        'order_id' => [
            'title' => 'Mã đơn hàng',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'driver_id' => [
            'title' => 'driver',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'user' => [
        'fullname' => [
            'title' => 'fullname',
            'orderable' => false
        ],
        'email' => [
            'title' => 'email',
            'orderable' => false,
            'visible' => false
        ],
        'phone' => [
            'title' => 'phone',
            'orderable' => false
        ],
        'gender' => [
            'title' => 'gender',
            'orderable' => false,
        ],
        'roles' => [
            'title' => 'role',
            'orderable' => false,
            'visible' => false
        ],
        'area_id' => [
            'title' => 'area',
            'orderable' => false,
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center'
        ],
    ],
    'productstore' => [
        'checkbox' => [
            'title' => 'checkbox',
            'width' => '5px',
            'orderable' => false,
            'searchable' => false,
        ],
        'name' => [
            'title' => 'Tên',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'price' => [
            'title' => 'giá',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'price_selling' => [
            'title' => 'giá bán',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'sku' => [
            'title' => 'đơn vị',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'qty' => [
            'title' => 'số lượng',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'in_stock' => [
            'title' => 'Tình trạng',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'status' => [
            'title' => 'Trạng thái',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'Ngày Tạo',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        // 'items' => [
        //     'title' => 'topping',
        //     'orderable' => false,
        //     'addClass' => 'align-middle'
        // ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'discount' => [
        'code' => [
            'title' => 'Mã',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'date_start' => [
            'title' => 'Ngày bắt đầu',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'date_end' => [
            'title' => 'Ngày kết thúc',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'max_usage' => [
            'title' => 'Số lượng phiếu',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'min_order_amount' => [
            'title' => 'Giá trị ĐH',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'type' => [
            'title' => 'Loại',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'discount_value' => [
            'title' => 'giá trị giảm',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'driver' => [
        'fullname' => [
            'title' => 'fullname',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'id_card' => [
            'title' => 'id_card',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'bank_name' => [
            'title' => 'bank_name',
            'addClass' => 'align-middle',
            'orderable' => false,
        ],
        'roles' => [
            'title' => 'role',
            'orderable' => false,
            'visible' => false
        ],
        'order_accepted' => [
            'title' => 'status',
            'orderable' => false,
        ],
        'auto_accept' => [
            'title' => 'receive_the_trip',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],

        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'topping' => [
        'name' => [
            'title' => 'name',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'type' => [
            'title' => 'type',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'obligatory' => [
            'title' => 'obligatory',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'orderstore' => [
        'code' => [
            'title' => 'orderCode',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'customer_id' => [
            'title' => 'customer',
            'addClass' => 'align-middle',
            'orderable' => false,
            'visible' => false

        ],
        'driver_id' => [
            'title' => 'driver',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],

        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'items' => [
            'title' => 'Chi tiết ĐH',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'system_revenue' => [
            'title' => '% Hệ thống',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'orderitem' => [
        'product_id' => [
            'title' => 'Tên SP',
            'addClass' => 'align-middle',
            'orderable' => false,


        ],
        'unit_price' => [
            'title' => 'đơn giá',
            'orderable' => false,

            'addClass' => 'align-middle'
        ],

        'qty' => [
            'title' => 'qty',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'detail' => [
            'title' => 'chi tiết',
            'orderable' => false,
            'visible' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'orderstore' => [
        'code' => [
            'title' => 'orderCode',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'customer_id' => [
            'title' => 'customer',
            'addClass' => 'align-middle',
            'orderable' => false,
            'visible' => false

        ],
        'driver_id' => [
            'title' => 'driver',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => false
        ],

        'status' => [
            'title' => 'status',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle',
            'visible' => true
        ],
        'items' => [
            'title' => 'Chi tiết ĐH',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'system_revenue' => [
            'title' => '% Hệ thống',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],
    'prioritie' => [
        'store_id' => [
            'title' => 'Tên cửa hàng',
            'addClass' => 'align-middle',
            'orderable' => false,
        ],
        'day' => [
            'title' => 'Số ngày ĐK',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],

        'total' => [
            'title' => 'total',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'created_at' => [
            'title' => 'createdAt',
            'orderable' => false,
            'addClass' => 'align-middle'
        ],
        'action' => [
            'title' => 'action',
            'orderable' => false,
            'exportable' => false,
            'printable' => false,
            'addClass' => 'text-center align-middle'
        ],
    ],

];
