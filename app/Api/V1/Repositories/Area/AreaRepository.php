<?php

namespace App\Api\V1\Repositories\Area;
use \App\Admin\Repositories\Area\AreaRepository as AdminArea;
use App\Api\V1\Repositories\Category\CategoryRepositoryInterface;

class AreaRepository extends AdminArea implements AreaRepositoryInterface
{


    public function getTree(){
        $this->instance = $this->model->published()
            ->orderBy('position', 'ASC')
            ->get()
            ->toTree();

        return $this->instance;
    }
}
