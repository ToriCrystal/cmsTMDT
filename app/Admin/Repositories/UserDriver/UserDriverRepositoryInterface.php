<?php

namespace App\Admin\Repositories\UserDriver;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface UserDriverRepositoryInterface extends EloquentRepositoryInterface
{

    public function count();
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
