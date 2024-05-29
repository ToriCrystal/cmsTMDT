<?php

namespace App\Api\V1\Repositories\Admin;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface AdminRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTree();
}
