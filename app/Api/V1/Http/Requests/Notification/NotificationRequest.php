<?php

namespace App\Api\V1\Http\Requests\Notification;

use App\Api\V1\Http\Requests\BaseRequest;

class NotificationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut(): array
    {
        return [
            'user_id' =>'required|exists:users,id',
            'device_token' => ['required|string']
        ];
    }
    protected function methodGet()
    {
        return [];
    }

    protected function methodDelete()
    {
        return [
            'id' => ['required', 'exists:App\Models\Note,id'],
        ];
    }
}
