<?php

namespace App\Admin\Http\Requests\Notification;

use App\Admin\Http\Requests\BaseRequest;


class NotificationStoreRequest extends BaseRequest
{
    protected function methodGet(): array
    {
        return [
            'store_id' => 'required|exists:stores,id',
        ];
    }


    protected function methodPatch(): array
    {
        return [
            'store_id' => 'required|exists:stores,id',
        ];
    }
}
