<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    protected array $services = [
        'App\Admin\Services\Admin\AdminServiceInterface' => 'App\Admin\Services\Admin\AdminService',
        'App\Admin\Services\User\UserServiceInterface' => 'App\Admin\Services\User\UserService',
        'App\Admin\Services\UserDriver\UserDriverServiceInterface' => 'App\Admin\Services\UserDriver\UserDriverService',
        'App\Admin\Services\Blog\Category\CategoryServiceInterface' => 'App\Admin\Services\Blog\Category\CategoryService',
        'App\Admin\Services\Blog\Post\PostServiceInterface' => 'App\Admin\Services\Blog\Post\PostService',
        'App\Admin\Services\Slider\SliderServiceInterface' => 'App\Admin\Services\Slider\SliderService',
        'App\Admin\Services\Slider\SliderItemServiceInterface' => 'App\Admin\Services\Slider\SliderItemService',
        'App\Admin\Services\Page\PageServiceInterface' => 'App\Admin\Services\Page\PageService',
        'App\Admin\Services\Blog\Tag\TagServiceInterface' => 'App\Admin\Services\Blog\Tag\TagService',
        'App\Admin\Services\Area\AreaServiceInterface' => 'App\Admin\Services\Area\AreaService',
        'App\Admin\Services\Store\Category\StoreCategoryServiceInterface' => 'App\Admin\Services\Store\Category\StoreCategoryService',
        'App\Admin\Services\Store\StoreServiceInterface' => 'App\Admin\Services\Store\StoreService',
        'App\Admin\Services\Product\ProductServiceInterface' => 'App\Admin\Services\Product\ProductService',
        'App\Admin\Services\Cart\CartServiceInterface' => 'App\Admin\Services\Cart\CartService',
        'App\Admin\Services\CartItem\CartItemServiceInterface' => 'App\Admin\Services\CartItem\CartItemServiceInterface',
        'App\Admin\Services\Order\OrderServiceInterface' => 'App\Admin\Services\Order\OrderService',
        'App\Admin\Services\OrderItem\OrderItemServiceInterface' => 'App\Admin\Services\OrderItem\OrderItemService',
        'App\Admin\Services\Product\ToppingServiceInterface' => 'App\Admin\Services\Product\ToppingService',
        'App\Admin\Services\Notification\NotificationServiceInterface' => 'App\Admin\Services\Notification\NotificationService',
        'App\Admin\Services\Rate\RateServiceInterface' => 'App\Admin\Services\Rate\RateService',
        'App\Admin\Services\Prioritizes\PrioritizeServiceInterface' => 'App\Admin\Services\Prioritizes\PrioritizeService',
        'App\Admin\Services\DriverTransaction\TransactionServiceInterface' => 'App\Admin\Services\DriverTransaction\TransactionService',

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
