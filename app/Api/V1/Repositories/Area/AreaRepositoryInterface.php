<?php

namespace App\Api\V1\Repositories\Area;
use App\Admin\Repositories\EloquentRepositoryInterface;

interface AreaRepositoryInterface extends EloquentRepositoryInterface
{
    public function getTree();
}
