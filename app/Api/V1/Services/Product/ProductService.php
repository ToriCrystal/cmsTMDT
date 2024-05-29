<?php

namespace App\Api\V1\Services\Product;

use App\Api\V1\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductService implements ProductServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;

    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function getInstance()
    {
        return $this->instance;
    }


    public function getByCategory(Request $request)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $limit = $data['limit'] ?? 10;
        return $this->repository->getByQueryBuilder(['category_id' => $data['category_id']])
            ->paginate($limit, ['*'], 'page', $page);

    }

    public function getByStore(Request $request)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $limit = $data['limit'] ?? 10;
        return $this->repository->getByQueryBuilder(['store_id' => $data['store_id']])
            ->paginate($limit, ['*'], 'page', $page);

    }

    public function searchProducts(Request $request)
    {
        $data = $request->validated();
        $page = $data['page'] ?? 1;
        $limit = $data['limit'] ?? 10;
        $searchTerm = $data['keyword'] ?? '';

        $query = $this->repository->getQueryBuilder();

        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('sku', 'LIKE', "%{$searchTerm}%");
            });
        }

        return $query->paginate($limit, ['*'], 'page', $page);
    }


    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function update(Request $request)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


}
