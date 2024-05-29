<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'store.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'roles' => [App\Enums\Store\StoreStatus::Open,
        App\Enums\Store\StoreStatus::Close

    ],
        'sub' => []
    ],
    [
        'title' => 'Sản phẩm',
        'routeName' => null,
        'icon' => '<i class="ti ti-tag"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'store.product.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    // App\Enums\Store\StoreStatus::Open,
                    // App\Enums\Store\StoreStatus::Close

                ],
            ],
            [
                'title' => 'list',
                'routeName' => 'store.product.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],

        ]
    ],
    [
        'title' => 'Topping',
        'routeName' => null,
        'icon' => '<i class="ti ti-square-rotated"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'store.topping.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    // App\Enums\Store\StoreStatus::Open,
                    // App\Enums\Store\StoreStatus::Close

                ],
            ],
            [
                'title' => 'list',
                'routeName' => 'store.topping.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],

        ]
    ],
    [
        'title' => 'Đơn hàng',
        'routeName' => null,
        'icon' => '<i class="ti ti-heart"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'Danh sách đơn hàng',
                'routeName' => 'store.order.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'Mã giảm giá',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'store.discount.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    // App\Enums\Store\StoreStatus::Open,
                    // App\Enums\Store\StoreStatus::Close

                ],
            ],
            [
                'title' => 'list',
                'routeName' => 'store.discount.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'Ưu tiên hiển thị',
        'routeName' => 'store.prioritize.index',
        'icon' => '<i class="ti ti-settings"></i>',
        'roles' => [],
        'sub' => [
        ]
    ],
 
];