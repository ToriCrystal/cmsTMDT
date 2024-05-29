<?php

namespace App\Api\V1\Http\Controllers\Cart;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Cart\CartItemRequest;
use App\Api\V1\Http\Requests\Cart\CartRequest;
use App\Api\V1\Http\Resources\Cart\CartResourceCollection;
use App\Api\V1\Repositories\Cart\CartRepositoryInterface;
use App\Api\V1\Services\Cart\CartServiceInterface;
use App\Api\V1\Services\CartItem\CartItemServiceInterface;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;

/**
 * @group Chuyên mục
 */
class CartController extends Controller
{
    private CartItemServiceInterface $cartItemService;

    public function __construct(
        CartRepositoryInterface  $repository,
        CartServiceInterface     $service,
        CartItemServiceInterface $cartItemService,
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->cartItemService = $cartItemService;
    }
    public function calculateTotal(CartItemRequest $request): JsonResponse
    {

        return $this->service->calculateTotal($request);

    }

    public function index(Request $request): JsonResponse
    {


        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => []
        ]);
    }

    public function store(CartRequest $request): JsonResponse
    {
        $cart = $this->cartItemService->store($request);

        return response()->json([
            'status' => 200,
            'message' => __('Cart created successfully.'),
            'data' => $cart
        ]);
    }

    public function update(CartRequest $request): JsonResponse
    {

        $cart = $this->cartItemService->update($request);

        return response()->json([
            'status' => 200,
            'message' => __('Cart updated successfully.'),
            'data' => $cart
        ]);
    }

    public function show(CartRequest $request): JsonResponse
    {
        $cartItems = $this->service->getCartItemsByUserId($request);

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new CartResourceCollection($cartItems)
        ]);
    }

    public function delete(CartRequest $request): JsonResponse
    {
        $this->cartItemService->delete($request['id']);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => []
        ]);
    }

}
