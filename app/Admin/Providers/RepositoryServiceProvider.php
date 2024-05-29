<?php

namespace App\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        'App\Admin\Repositories\Admin\AdminRepositoryInterface' => 'App\Admin\Repositories\Admin\AdminRepository',
        'App\Admin\Repositories\User\UserRepositoryInterface' => 'App\Admin\Repositories\User\UserRepository',
        'App\Admin\Repositories\UserDriver\UserDriverRepositoryInterface' => 'App\Admin\Repositories\UserDriver\UserDriverRepository',
        'App\Admin\Repositories\Setting\SettingRepositoryInterface' => 'App\Admin\Repositories\Setting\SettingRepository',
        'App\Admin\Repositories\Category\CategoryRepositoryInterface' => 'App\Admin\Repositories\Category\CategoryRepository',
        'App\Admin\Repositories\Post\PostRepositoryInterface' => 'App\Admin\Repositories\Post\PostRepository',
        'App\Admin\Repositories\Slider\SliderRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderRepository',
        'App\Admin\Repositories\Slider\SliderItemRepositoryInterface' => 'App\Admin\Repositories\Slider\SliderItemRepository',
        'App\Admin\Repositories\Page\PageRepositoryInterface' => 'App\Admin\Repositories\Page\PageRepository',
        'App\Admin\Repositories\Tag\TagRepositoryInterface' => 'App\Admin\Repositories\Tag\TagRepository',
        'App\Admin\Repositories\Area\AreaRepositoryInterface' => 'App\Admin\Repositories\Area\AreaRepository',
        'App\Admin\Repositories\StoreCategory\StoreCategoryRepositoryInterface' => 'App\Admin\Repositories\StoreCategory\StoreCategoryRepository',
        'App\Admin\Repositories\Store\StoreRepositoryInterface' => 'App\Admin\Repositories\Store\StoreRepository',
        'App\Admin\Repositories\Product\ProductRepositoryInterface' => 'App\Admin\Repositories\Product\ProductRepository',
        'App\Admin\Repositories\Cart\CartRepositoryInterface' => 'App\Admin\Repositories\Cart\CartRepository',
        'App\Admin\Repositories\CartItem\CartItemRepositoryInterface' => 'App\Admin\Repositories\CartItem\CartItemRepository',
        'App\Admin\Repositories\Order\OrderRepositoryInterface' => 'App\Admin\Repositories\Order\OrderRepository',
        'App\Admin\Repositories\OrderItem\OrderItemRepositoryInterface' => 'App\Admin\Repositories\OrderItem\OrderItemRepository',
        'App\Admin\Repositories\Product\ToppingRepositoryInterface' => 'App\Admin\Repositories\Product\ToppingRepository',
        'App\Admin\Repositories\Notification\NotificationRepositoryInterface' => 'App\Admin\Repositories\Notification\NotificationRepository',
        'App\Admin\Repositories\Order\OrderItemRepositoryInterface'=>'App\Admin\Repositories\Order\OrderItemRepository',
        'App\Admin\Repositories\Rate\RateRepositoryInterface'=>'App\Admin\Repositories\Rate\RateRepository',
        'App\Admin\Repositories\Prioritizes\PrioritizeRepositoryInterface'=>'App\Admin\Repositories\Prioritizes\PrioritizeRepository',
        'App\Admin\Repositories\DriverTransaction\TransactionRepositoryInterface'=>'App\Admin\Repositories\DriverTransaction\TransactionRepository',
        'App\Admin\Repositories\Store\StorePrioritieRepositoryInterface'=>'App\Admin\Repositories\Store\StorePrioritieRepository',
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
