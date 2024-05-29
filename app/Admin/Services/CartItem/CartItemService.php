<?php

namespace App\Admin\Services\CartItem;

use App\Admin\Repositories\Cart\CartRepositoryInterface;
use Illuminate\Http\Request;

class CartItemService implements CartItemServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    public function __construct(CartRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function store(Request $request){

        $this->data = $request->validated();

        $area = $this->repository->create($this->data);

        return $area;
    }

    public function update(Request $request){

        $this->data = $request->validated();

        $area = $this->repository->update($this->data['id'], $this->data);

        return $area;
    }

    public function delete($id){
        return $this->repository->delete($id);
    }
}
