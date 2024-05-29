<?php

namespace App\Admin\Services\Product;

use  App\Admin\Repositories\Page\PageRepositoryInterface;
use App\Admin\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Enums\DefaultStatus;


class ProductService implements ProductServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(ProductRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $this->data = $request->validated();

        $product = $this->repository->create($this->data);

        return $product;
    }

    public function update(Request $request){
        $this->data = $request->validated();
        $product = $this->repository->update($this->data['id'], $this->data);
        return $product;
    }
    public function getproduct($id){
        $result = Product::where('store_id',$id)->get();
        return $result;
    }
    public function delete($id){
        return $this->repository->delete($id);
    }
    public function draft($id){
        $result = Product::where('id',$id)->first();
        $result->status=DefaultStatus::Draft;
        $result->save();
        return $result;
    }


}
