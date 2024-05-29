<?php

namespace App\Api\V1\Repositories\Store;
use App\Admin\Repositories\Store\StoreRepository as AdminCategoryRepository;

class StoreRepository extends AdminCategoryRepository implements StoreRepositoryInterface
{
    public function getTree(){
        $this->instance = $this->model->published()
        ->orderBy('position', 'ASC')
        ->get()
        ->toTree();

        return $this->instance;
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
            return $query->where('name', 'LIKE', '%'.$key.'%')
                ->orWhere('sku', 'LIKE', '%'.$key.'%');

        });
    }

}
