<?php

namespace App\Api\V1\Repositories\Store;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface StoreRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTree();
    public function searchAllLimit($value = '', $meta = [], $limit = 10);
}
