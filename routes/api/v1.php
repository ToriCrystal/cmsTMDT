<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth
Route::controller(App\Api\V1\Http\Controllers\Auth\AuthController::class)
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/auth')->as('auth.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::put('/', 'update')->name('update');
            Route::put('/update-password', 'updatePassword')->name('update_password');
        });

        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });
//cart
Route::controller(App\Api\V1\Http\Controllers\Cart\CartController::class)
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/carts')->as('cart.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::post('/calculate', 'calculateTotal')->name('calculate');
            Route::post('/', 'store')->name('store');
            Route::put('/', 'update')->name('update');
            Route::delete('/', 'delete')->name('delete');
        });
    });

//order
Route::controller(App\Api\V1\Http\Controllers\Order\OrderController::class)
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/orders')->as('order.')->group(function () {
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{userId}/users', 'getByDriver')->name('driver');
            Route::post('/', 'store')->name('store');
            Route::patch('/status', 'updateStatus')->name('status');
            Route::put('/', 'update')->name('update');
            Route::delete('/', 'delete')->name('delete');
            Route::get('/trip-status/{id}', 'getTripStatus')->name('get-trip-status');
        });
    });


//upload
Route::controller(App\Api\V1\Http\Controllers\Upload\UploadController::class)
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/uploads')->as('upload.')->group(function () {
            Route::post('/image', 'uploadImage')->name('image');
        });

    });

//transaction driver
Route::controller(App\Api\V1\Http\Controllers\Transaction\TransactionController::class)
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/transactions')->as('transaction.')->group(function () {
            Route::post('/', 'store')->name('store');
        });

    });

Route::controller(App\Api\V1\Http\Controllers\UserDriver\UserDriverController::class)
    ->prefix('/drivers')->as('driver.')
    ->group(function () {
        Route::post('/', 'store')->name('store');

        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/{id}', 'show')->name('show');
            Route::put('/{id}', 'update')->name('update');
        });
    });


//area
Route::controller(App\Api\V1\Http\Controllers\Area\AreaController::class)
    ->prefix('/areas')
    ->as('area.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
    });

//category
Route::controller(App\Api\V1\Http\Controllers\Category\CategoryController::class)
    ->prefix('/categories')
    ->as('category.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
    });

//product
Route::controller(App\Api\V1\Http\Controllers\Product\ProductController::class)
    ->prefix('/products')
    ->as('product.')
    ->group(function () {
        Route::get('/by-category', 'getByCategory')->name('getByCategory');
        Route::get('/by-store', 'getByStore')->name('getByStore');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/search', 'search')->name('search');
    });


//posts
Route::controller(App\Api\V1\Http\Controllers\Post\PostController::class)
    ->prefix('/posts')
    ->as('post.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{id}', 'show')->name('show');
        Route::get('/related/{id}', 'related')->name('related');
    });

//Notification
Route::controller(App\Api\V1\Http\Controllers\Notification\NotificationController::class)
    ->prefix('/notes')
    ->as('note.')
    ->group(function () {
        Route::middleware('auth:sanctum')->prefix('/notifications')->as('notification.')->group(function () {
            Route::put('/update-device-token', 'updateDeviceToken')->name('updateToken');
        });
        Route::get('/get', 'get')->name('get');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/user/{user_id}', 'getUserNotifications')->name('detailUser');
        Route::delete('/destroy/{id}', 'destroy')->name('destroy');
    });


Route::controller(App\Api\V1\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('reset_password.')
    ->group(function () {
        Route::post('/', 'checkAndSendMail')->name('check_and_send_mail');
    });

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'message' => __('Không tìm thấy đường dẫn.')
    ], 404);
});
