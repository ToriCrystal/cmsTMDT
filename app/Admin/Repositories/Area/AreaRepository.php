<?php

namespace App\Admin\Repositories\Area;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Area\AreaRepositoryInterface;
use App\Models\Area;

class AreaRepository extends EloquentRepository implements AreaRepositoryInterface
{
    public function getModel(){
        return Area::class;
    }
    
    public function getByOrder(array $filter, array $relations = [], $sort = ['id', 'desc'])
    {
        $this->getByQueryBuilder($filter, $relations, $sort);

        return $this->instance->get();
    }

    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){

        $this->instance = $this->model->where('name', 'like', '%'.$keySearch.'%');
        
        $this->applyFilters($meta);

        return $this->instance->published()->orderBy('position', 'asc')->limit($limit)->get();
    }
}