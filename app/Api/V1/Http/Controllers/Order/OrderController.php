<?php

namespace App\Api\V1\Http\Controllers\Order;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Order\OrderRequest;
use App\Api\V1\Http\Resources\Order\OrderResource;
use App\Api\V1\Http\Resources\Order\OrderResourceCollection;
use App\Api\V1\Repositories\Order\OrderRepositoryInterface;
use App\Api\V1\Repositories\User\UserRepositoryInterface;
use App\Api\V1\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Api\V1\Services\Order\OrderServiceInterface;
use App\Api\V1\Validate\Validator;
use Exception;
use Illuminate\Http\JsonResponse;


/**
 * @group Đơn hàng
 */
class OrderController extends Controller
{
    private UserDriverRepositoryInterface $userDriverRepository;
    private UserRepositoryInterface $userRepository;

    public function __construct(
        OrderRepositoryInterface      $repository,
        OrderServiceInterface         $service,
        UserDriverRepositoryInterface $userDriverRepository,
        UserRepositoryInterface $userRepository

    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->userDriverRepository = $userDriverRepository;
        $this->userRepository = $userRepository;

    }



    public function store(OrderRequest $request): JsonResponse
    {
        $response = $this->service->store($request);

        return response()->json([
            'status' => 200,
            'message' => __('Order created successfully.'),
            'data' => $response
        ]);
    }


    public function update($id, OrderRequest $request): JsonResponse
    {

        $cart = $this->service->update($request);

        return response()->json([
            'status' => 200,
            'message' => __('Cart updated successfully.'),
            'data' => $cart
        ]);
    }

    /**
     * @throws Exception
     */
    public function show($id): JsonResponse
    {
        if (Validator::validateExists($this->repository, $id)) {
            $response = $this->repository->findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => new OrderResource($response)
            ]);
        }
        throw new  Exception();

    }

    /**
     * @throws Exception
     */
    public function getByDriver($userId): JsonResponse
    {
        $limit = request()->input('limit', 10);
        $page = request()->input('page', 1);
        if (Validator::validateExists($this->userRepository, $userId)) {
            $response = $this->service->getOrderByDriver($userId, $limit, $page);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => new OrderResourceCollection($response)
            ]);
        }
        throw new  Exception();
    }

    public function delete($id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => []
        ]);
    }


    public function updateStatus(OrderRequest $request): JsonResponse
    {
        $response = $this->service->updateStatus($request);
        if ($response) {
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => []
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('notifyError'),
            'data' => []
        ]);

    }

    public function getTripStatus($id)
    {
        $order = $this->repository->findOrFail($id);

        if (!$order) {
            return response()->json([
                'status' => 404,
                'message' => 'Order does not exist',
            ], 404);
        }

        // if ($order instanceof JsonResponse) {
        //     return $order;
        // }

        if ($order->driver_id) {

            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => [
                    'driver_id' => $order->driver_id,
                    'customer_id' => $order->customer_id,
                    'store_id' => $order->store_id,
                    'status' => $order->status,
                    'shipping_address' => $order->shipping_address,
                    'shipping_method' => $order->shipping_method,
                    'payment_method' => $order->payment_method,
                    'sub_total' => $order->sub_total,
                    'transport_fee' => $order->transport_fee,
                    'total' => $order->total,
                    'created_at' => $order->created_at
                ]
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'No driver has accepted the order yet',
                'data' => null
            ]);
        }
    }

}
