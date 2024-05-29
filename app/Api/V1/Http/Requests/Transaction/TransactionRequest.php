<?php

namespace App\Api\V1\Http\Requests\Transaction;

use App\Api\V1\Http\Requests\BaseRequest;


class TransactionRequest extends BaseRequest
{
    protected function methodPost(): array
    {
        return [
            'driver_id' => 'required|integer|exists:user_driver_info,id',
            'order_id' => 'required|integer|exists:orders,id',
            'transaction_code' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'feature_image' => 'nullable|string',
            'gallery' => 'nullable|json',
        ];
    }


}
