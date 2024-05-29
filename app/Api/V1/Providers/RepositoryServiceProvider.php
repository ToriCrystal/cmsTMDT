<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Api\V1\Repositories\User\UserRepositoryInterface' => 'App\Api\V1\Repositories\User\UserRepository',
        'App\Api\V1\Repositories\Admin\AdminRepositoryInterface' => 'App\Api\V1\Repositories\Admin\AdminRepository',
        'App\Api\V1\Repositories\UserDriver\UserDriverRepositoryInterface' => 'App\Api\V1\Repositories\UserDriver\UserDriverRepository',
        // 'App\Api\V1\Repositories\Slider\SliderRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderRepository',
        // 'App\Api\V1\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Api\V1\Repositories\Slider\SliderItemRepository',
        'App\Api\V1\Repositories\Post\PostRepositoryInterface' => 'App\Api\V1\Repositories\Post\PostRepository',
        'App\Api\V1\Repositories\Category\CategoryRepositoryInterface' => 'App\Api\V1\Repositories\Category\CategoryRepository',
        'App\Api\V1\Repositories\Area\AreaRepositoryInterface' => 'App\Api\V1\Repositories\Area\AreaRepository',
        'App\Api\V1\Repositories\Cart\CartRepositoryInterface' => 'App\Api\V1\Repositories\Cart\CartRepository',
        'App\Api\V1\Repositories\CartItem\CartItemRepositoryInterface' => 'App\Api\V1\Repositories\CartItem\CartItemRepository',
        'App\Api\V1\Repositories\Order\OrderRepositoryInterface' => 'App\Api\V1\Repositories\Order\OrderRepository',
        'App\Api\V1\Repositories\OrderItem\OrderItemRepositoryInterface' => 'App\Api\V1\Repositories\OrderItem\OrderItemRepository',
        'App\Api\V1\Repositories\Product\ProductRepositoryInterface' => 'App\Api\V1\Repositories\Product\ProductRepository',
        'App\Api\V1\Repositories\Store\StoreRepositoryInterface' => 'App\Api\V1\Repositories\Store\StoreRepository',
        'App\Api\V1\Repositories\Notification\NotificationRepositoryInterface' => 'App\Api\V1\Repositories\Notification\NotificationRepository',
        'App\Api\V1\Repositories\Setting\SettingRepositoryInterface' => 'App\Api\V1\Repositories\Setting\SettingRepository',
        'App\Api\V1\Repositories\DriverTransaction\TransactionRepositoryInterface' => 'App\Api\V1\Repositories\DriverTransaction\TransactionRepository',
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->repositories as $interface => $implement) {
            $this->app->singleton($interface, $implement);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
