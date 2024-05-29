<?php

namespace App\Api\V1\Http\Requests\Cart;

use App\Api\V1\Http\Requests\BaseRequest;

class CartRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet(): array
    {
        return [
            'user_id' =>'required|exists:users,id',
            'page' =>'required|integer',
            'limit' => 'sometimes|required|integer|min:1',
        ];
    }
    protected function methodPost(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'cart_id' =>'required|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ];
    }
    protected function methodDelete(): array
    {
        return [
            'id' => 'required|exists:carts,id',
        ];
    }
}
