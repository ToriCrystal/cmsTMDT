<?php

namespace App\Api\V1\Repositories\Order;

use App\Admin\Repositories\Order\OrderRepository as AdminCategoryRepository;
use App\Models\Order;

class OrderRepository extends AdminCategoryRepository implements OrderRepositoryInterface
{

    public function getModel(): string
    {
        return Order::class;
    }
    public function getTree()
    {
        $this->instance = $this->model->published()
            ->orderBy('position', 'ASC')
            ->get()
            ->toTree();

        return $this->instance;
    }

    public function findByIdWithAncestorsAndDescendants($id)
    {
        $this->findOrFail($id);

        $this->instance = $this->instance->load([
            'ancestors' => function ($query) {
                $query->defaultOrder();
            },
            'descendants'
        ]);
        return $this->instance;
    }
}
