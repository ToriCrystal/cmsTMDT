<?php

namespace App\Admin\Http\Requests\Transaction;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Driver\DriverTransactionStatus;
use App\Enums\Notification\NotificationStatus;
use Illuminate\Validation\Rules\Enum;

class TransactionRequest extends BaseRequest
{


    protected function methodPost(): array
    {
        return [
            'title' => ['required', 'string'],
            'message' => ['required'],
            'user_id' => ['nullable'],
            'device_token' => ['required'],
            'status' => ['required', new Enum(NotificationStatus::class)],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\DriverTransaction,id'],
            'transaction_code' => ['nullable', 'string'],
            'amount' => ['nullable'],
            'description' => ['nullable'],
            'feature_image' => ['required', 'string'],
            'status' => ['required', new Enum(DriverTransactionStatus::class)],
        ];
    }

}
