<?php

namespace App\Api\V1\Http\Controllers\Product;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Product\ProductCategoryRequest;
use App\Api\V1\Http\Requests\Product\ProductRequest;
use App\Api\V1\Http\Requests\Product\ProductStoreRequest;
use App\Api\V1\Http\Resources\Product\ProductResource;
use App\Api\V1\Http\Resources\Product\ProductResourceCollection;
use App\Api\V1\Repositories\Product\ProductRepositoryInterface;
use App\Api\V1\Services\Product\ProductServiceInterface;
use App\Api\V1\Validate\Validator;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group Sản phẩm
 */
class ProductController extends Controller
{
    public function __construct(
        ProductRepositoryInterface $repository,
        ProductServiceInterface    $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * @throws Exception
     */
    public function getByCategory(ProductCategoryRequest $request): JsonResponse
    {
        $response = $this->service->getByCategory($request);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new ProductResourceCollection($response)
        ]);
    }

    /**
     * @throws Exception
     */
    public function getByStore(ProductStoreRequest $request): JsonResponse
    {
        $response = $this->service->getByStore($request);
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new ProductResourceCollection($response)
        ]);
    }

    /**
     * @throws Exception
     */
    public function show($id){
        if (Validator::validateExists($this->repository, $id)) {
            $response = $this->repository->findOrFail($id);
            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => new ProductResource($response)
            ]);
        }
    }

    public function search(ProductRequest $request): JsonResponse
    {
        $response = $this->service->searchProducts($request);

        return response()->json([
            'status' => 200,
            'message' => __('Product search results'),
            'data' => new ProductResourceCollection($response)
        ]);
    }


}
