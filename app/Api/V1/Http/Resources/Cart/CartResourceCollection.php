<?php

namespace App\Api\V1\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
      return [
          'carts' => $this->collection->map(function ($cartItem) {
              return new CartItemResource($cartItem);
          }),
          'links' => [
              'first' => $this->url(1),
              'last' => $this->url($this->lastPage()),
              'prev' => $this->previousPageUrl(),
              'next' => $this->nextPageUrl(),
          ],
          'meta' => [
              'current_page' => $this->currentPage(),
              'from' => $this->firstItem(),
              'to' => $this->lastItem(),
              'limit' => $this->perPage(),
              'total' => $this->total(),
              'count' => $this->count(),
              'total_pages' => $this->lastPage(),
          ],
      ];
    }
}
