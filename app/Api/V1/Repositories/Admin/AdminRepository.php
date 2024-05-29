<?php

namespace App\Api\V1\Repositories\Admin;
use App\Admin\Repositories\Admin\AdminRepository as AdminArea;

class AdminRepository extends AdminArea implements AdminRepositoryInterface
{

    public function getTree(){
        $this->instance = $this->model->published()
            ->orderBy('position', 'ASC')
            ->get()
            ->toTree();

        return $this->instance;
    }
}
