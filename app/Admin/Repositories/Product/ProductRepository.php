<?php

namespace App\Admin\Repositories\Product;
use App\Admin\Repositories\EloquentRepository;
use App\Models\Product;

class ProductRepository extends EloquentRepository implements ProductRepositoryInterface
{
    public function getModel(){
        return Product::class;
    }
    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){
        $this->instance = $this->model;

        $this->getQueryBuilderFindByKey($keySearch);

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }
    protected function getQueryBuilderFindByKey($key){
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('name', 'LIKE', '%'.$key.'%');
        });
    }
    public function updateQty($orders){

        foreach($orders as $item){
            $product = $this->model->where('id',$item->product_id)->get();
            foreach($product as $data){
                $data->qty = $data->qty - $item->qty;
                $data->save(); 
            }
        }
    }
}
