<?php

namespace App\Admin\Repositories\Store;
use App\Admin\Repositories\EloquentRepository;
use App\Admin\Repositories\Store\StorePrioritieRepositoryInterface;
use App\Models\Prioritize;

class StorePrioritieRepository extends EloquentRepository implements StorePrioritieRepositoryInterface
{
    public function getModel(){
        return Prioritize::class;
    }

    public function count(){
        return $this->model->count();
    }
    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){

        $this->instance = $this->model;

        $this->getQueryBuilderFindByKey($keySearch);

        $this->applyFilters($meta);

        return $this->instance->limit($limit)->get();
    }

    protected function getQueryBuilderFindByKey($key): void
    {
        $this->instance = $this->instance->where(function($query) use ($key){
            return $query->where('store_name', 'LIKE', '%'.$key.'%')
                ->orWhere('store_phone', 'LIKE', '%'.$key.'%')
                ->orWhere('contact_phone', 'LIKE', '%'.$key.'%');
        });
    }
}
