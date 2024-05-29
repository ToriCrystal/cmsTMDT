<?php

namespace App\Api\V1\Services\CartItem;

use App\Api\V1\Repositories\Cart\CartRepositoryInterface;
use App\Api\V1\Repositories\CartItem\CartItemRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    protected $instance;
    private CartItemRepositoryInterface $cartItemRepository;

    public function __construct(CartRepositoryInterface $repository,CartItemRepositoryInterface $cartItemRepository)
    {
        $this->repository = $repository;
        $this->cartItemRepository = $cartItemRepository;
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validated();

            $filter = [
                'cart_id' => $data['cart_id'],
                'product_id' => $data['product_id']
            ];
            $cartItem = $this->cartItemRepository->findByOrFail($filter);

            $newQty = $cartItem->qty + $data['qty'];
            $this->cartItemRepository->updateAttribute($cartItem->id, 'qty', $newQty);
            return $cartItem->refresh();
        } catch (ModelNotFoundException $e) {
            $cartItem = $this->cartItemRepository->create($data);
        }
        return $cartItem;
    }


    public function update(Request $request)
    {

        $this->data = $request->validated();

        return $this->cartItemRepository->update($this->data['id'], $this->data);

    }

    public function delete($id)
    {
        return $this->cartItemRepository->delete($id);

    }

    public function getInstance()
    {
        return $this->instance;
    }


}
