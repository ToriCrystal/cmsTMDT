<?php

namespace App\Admin\Http\Controllers\UserDriver;

use App\Admin\Http\Controllers\BaseSearchSelectController;
use App\Admin\Http\Resources\UserDriver\UserDriverSearchSelectResource;
use App\Admin\Repositories\UserDriver\UserDriverRepositoryInterface;

class UserDriverSearchSelectController extends BaseSearchSelectController
{
    public function __construct(
        UserDriverRepositoryInterface $repository
    ){
        $this->repository = $repository;
    }

    protected function selectResponse(){
        $this->instance = [
            'results' => UserDriverSearchSelectResource::collection($this->instance)
        ];
    }
}
