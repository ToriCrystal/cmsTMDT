<?php

return [
    [
        'title' => 'Dashboard',
        'routeName' => 'admin.dashboard',
        'icon' => '<i class="ti ti-home"></i>',
        'roles' => [
            App\Enums\Admin\AdminRoles::SuperAdmin,
            App\Enums\Admin\AdminRoles::Admin
        ],
        'sub' => []
    ],
    [
        'title' => 'page',
        'routeName' => null,
        'icon' => '<i class="ti ti-notebook"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.page.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.page.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ]
        ]
    ],
    [
        'title' => 'area',
        'routeName' => null,
        'icon' => '<i class="ti ti-square-rotated"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.area.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.area.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ]
        ]
    ],
    [
        'title' => 'store',
        'routeName' => null,
        'icon' => '<i class="ti ti-building-store"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.store.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.store.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
            [
                'title' => 'category2',
                'routeName' => 'admin.store.category.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
            [
                'title' => 'Danh sách ưu tiên',
                'routeName' => 'admin.shop.prioritie',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],

        ]
    ],
    [
        'title' => 'product',
        'routeName' => null,
        'icon' => '<i class="ti ti-tag"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.product.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
        ]
    ],
    [
        'title' => 'order',
        'routeName' => null,
        'icon' => '<i class="ti ti-heart"></i>',
        'roles' => [],
        'sub' => [
//            [
//                'title' => 'add',
//                'routeName' => 'admin.order.create',
//                'icon' => '<i class="ti ti-plus"></i>',
//                'roles' => [
//                    App\Enums\Admin\AdminRoles::SuperAdmin,
//                    App\Enums\Admin\AdminRoles::Admin
//                ],
//            ],
            [
                'title' => 'list',
                'routeName' => 'admin.order.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ]
        ]
    ],
    [
        'title' => 'transactions',
        'routeName' => null,
        'icon' => '<i class="ti ti-clipboard"></i>',
        'roles' => [],
        'sub' => [

            [
                'title' => 'list',
                'routeName' => 'admin.transaction.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
            [
                'title' => 'income',
                'routeName' => 'admin.transaction.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ]
        ]
    ],
    [
        'title' => 'Blog',
        'routeName' => null,
        'icon' => '<i class="ti ti-article"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'addPost',
                'routeName' => 'admin.blog.post.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
            [
                'title' => 'post',
                'routeName' => 'admin.blog.post.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
            [
                'title' => 'category',
                'routeName' => 'admin.blog.category.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ],
            [
                'title' => 'tag',
                'routeName' => 'admin.blog.tag.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [
                    App\Enums\Admin\AdminRoles::SuperAdmin,
                    App\Enums\Admin\AdminRoles::Admin
                ],
            ]
        ]
    ],
    [
        'title' => 'slider',
        'routeName' => null,
        'icon' => '<i class="ti ti-slideshow"></i>',
        'roles' => [],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.slider.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.slider.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'customer',
        'routeName' => null,
        'icon' => '<i class="ti ti-users"></i>',
        'roles' => [
            App\Enums\Admin\AdminRoles::SuperAdmin,
            App\Enums\Admin\AdminRoles::Admin
        ],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.user.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.user.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'driver',
        'routeName' => null,
        'icon' => '<i class="ti ti-car"></i>',
        'roles' => [
            App\Enums\Admin\AdminRoles::SuperAdmin,
            App\Enums\Admin\AdminRoles::Admin
        ],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.driver.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.driver.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
            [
                'title' => 'driverNew',
                'routeName' => 'admin.driver.newDriver',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'notifications',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-cog"></i>',
        'roles' => [
            App\Enums\Admin\AdminRoles::SuperAdmin,
            App\Enums\Admin\AdminRoles::Admin
        ],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.notification.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.notification.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'admin',
        'routeName' => null,
        'icon' => '<i class="ti ti-user-cog"></i>',
        'roles' => [
            App\Enums\Admin\AdminRoles::SuperAdmin,
            App\Enums\Admin\AdminRoles::Admin
        ],
        'sub' => [
            [
                'title' => 'add',
                'routeName' => 'admin.admin.create',
                'icon' => '<i class="ti ti-plus"></i>',
                'roles' => [],
            ],
            [
                'title' => 'list',
                'routeName' => 'admin.admin.index',
                'icon' => '<i class="ti ti-list"></i>',
                'roles' => [],
            ],
        ]
    ],
    [
        'title' => 'setting',
        'routeName' => null,
        'icon' => '<i class="ti ti-settings"></i>',
        'roles' => [
            App\Enums\Admin\AdminRoles::SuperAdmin,
            App\Enums\Admin\AdminRoles::Admin
        ],
        'sub' => [
            [
                'title' => 'generate',
                'routeName' => 'admin.setting.general',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
            ],
            [
                'title' => 'system_revenue',
                'routeName' => 'admin.setting.system',
                'icon' => '<i class="ti ti-tool"></i>',
                'roles' => [],
            ],
//            [
//                'title' => 'Giao diện',
//                'routeName' => 'admin.setting.appearance',
//                'icon' => '<i class="ti ti-brush"></i>',
//                'roles' => [],
//            ],
        ]
    ],
];
