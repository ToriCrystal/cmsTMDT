<?php

namespace App\Admin\Repositories\Discount;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Models\DiscountCodesProduct;

class ProductRepository extends EloquentRepository 
{
    public function getModel(){
        return DiscountCodesProduct::class;
    }
}