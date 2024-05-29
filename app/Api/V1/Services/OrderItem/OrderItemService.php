<?php

namespace App\Api\V1\Services\OrderItem;

use Illuminate\Http\Request;

class OrderItemService implements OrderItemServiceInterface
{
    /**
     * Current Object instance
     *
     * @var array
     */
    protected $data;

    protected $repository;

    protected $instance;


    public function __construct(OrderItemServiceInterface $repository,
    )
    {
        $this->repository = $repository;

    }


    /**
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        return $this->repository->create($data);
    }


    public function update(Request $request)
    {

        $this->data = $request->validated();

        return $this->repository->update($this->data['id'], $this->data);

    }

    public function delete($id)
    {
        return $this->repository->delete($id);

    }

    public function getInstance()
    {
        return $this->instance;
    }


}
