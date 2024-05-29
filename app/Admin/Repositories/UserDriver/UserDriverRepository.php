<?php

namespace App\Admin\Repositories\UserDriver;
use App\Admin\Repositories\EloquentRepository;
use App\Models\UserDriver;

class UserDriverRepository extends EloquentRepository implements UserDriverRepositoryInterface
{
    public function getModel(): string
    {
        return UserDriver::class;
    }

    public function count(){
        return $this->model->count();
    }
    public function searchAllLimit($keySearch = '', $meta = [], $limit = 10){

        $this->instance = $this->model;

        $this->getQueryBuilderFindByKey($keySearch);

        $this->applyFilters($meta);

        return $this->instance->driver()->limit($limit)->get();
    }
    protected function getQueryBuilderFindByKey($key): void
    {

        $this->instance = $this->instance->whereHas('user', function ($query) use ($key) {
            $query->where('phone', 'LIKE', "%$key%")
                ->orWhere('email', 'LIKE', "%$key%")
                ->orWhere('fullname', 'LIKE', "%$key%");
        });
    }
}
