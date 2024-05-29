<?php

namespace App\Admin\Repositories\Prioritizes;
use App\Admin\Repositories\EloquentRepository;
use App\Models\Prioritize;

class PrioritizeRepository extends EloquentRepository implements PrioritizeRepositoryInterface
{
    public function getModel(){
        return Prioritize::class;
    }
    
}
