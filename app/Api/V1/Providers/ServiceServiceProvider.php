<?php

namespace App\Api\V1\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected $services = [
        // 'App\Api\V1\Services\User\UserServiceInterface' => 'App\Api\V1\Services\User\UserService',
        'App\Api\V1\Services\UserDriver\UserDriverServiceInterface' => 'App\Api\V1\Services\UserDriver\UserDriverService',
        'App\Api\V1\Services\Auth\AuthServiceInterface' => 'App\Api\V1\Services\Auth\AuthService',
        'App\Api\V1\Services\Cart\CartServiceInterface' => 'App\Api\V1\Services\Cart\CartService',
        'App\Api\V1\Services\CartItem\CartItemServiceInterface' => 'App\Api\V1\Services\CartItem\CartItemService',
        'App\Api\V1\Services\Order\OrderServiceInterface' => 'App\Api\V1\Services\Order\OrderService',
        'App\Api\V1\Services\OrderItem\OrderItemServiceInterface' => 'App\Api\V1\Services\OrderItem\OrderItemService',
        'App\Api\V1\Services\Product\ProductServiceInterface' => 'App\Api\V1\Services\Product\ProductService',
        'App\Api\V1\Services\Notification\NotificationServiceInterface' => 'App\Api\V1\Services\Notification\NotificationService',
        'App\Api\V1\Services\DriverTransaction\TransactionServiceInterface' => 'App\Api\V1\Services\DriverTransaction\TransactionService',
        'App\Api\V1\Services\Upload\UploadServiceInterface' => 'App\Api\V1\Services\Upload\UploadService',


    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        foreach ($this->services as $interface => $implement) {
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
