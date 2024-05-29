<?php

namespace App\Api\V1\Http\Controllers\Transaction;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Transaction\TransactionRequest;
use App\Api\V1\Http\Resources\Transaction\TransactionResource;
use App\Api\V1\Repositories\DriverTransaction\TransactionRepositoryInterface;
use App\Api\V1\Services\DriverTransaction\TransactionServiceInterface;
use Illuminate\Http\JsonResponse;


/**
 * @group Transaction
 */
class TransactionController extends Controller
{
    public function __construct(
        TransactionRepositoryInterface $repository,
        TransactionServiceInterface    $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;

    }

    public function store(TransactionRequest $request): JsonResponse
    {
        $response = $this->service->store($request);
        if($response){
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => new TransactionResource($response)
            ]);
        }
        return response()->json([
            'status' => 400,
            'message' => __('notifyError'),
        ]);

    }

    public function index(): JsonResponse
    {

        $areas = $this->repository->getAll();

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $areas
        ]);
    }

}
