<?php

namespace App\Admin\Repositories\Discount;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Discount\DiscountRepositoryInterface;
use App\Models\Discount;

class DiscountRepository extends EloquentRepository implements DiscountRepositoryInterface
{
    public function getModel(){
        return Discount::class;
    }
}