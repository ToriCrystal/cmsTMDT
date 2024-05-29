<?php

namespace App\Store\Http\Controllers\Product;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use App\Admin\Http\Resources\Product\ProductSearchSelectResource;

class UserSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        ProductRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => ProductSearchSelectResource::collection($this->instance)
        ];
    }
}