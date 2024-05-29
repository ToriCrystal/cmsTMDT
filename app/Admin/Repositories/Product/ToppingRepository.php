<?php

namespace App\Admin\Repositories\Product;
use App\Admin\Repositories\EloquentRepository;
use App\Models\Topping;

class ToppingRepository extends EloquentRepository implements ToppingRepositoryInterface
{
    public function getModel(){
        return Topping::class;
    }
}
