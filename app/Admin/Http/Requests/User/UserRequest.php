<?php

namespace App\Admin\Http\Requests\User;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\User\AutoNotification;
use App\Enums\User\UserRole;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Gender;

class UserRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [
//            'username' => [
//                'required',
//                'string', 'min:6', 'max:50',
//                'unique:App\Models\User,username',
//                'regex:/^[A-Za-z0-9_-]+$/',
//                function ($attribute, $value, $fail) {
//                    if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
//                        $fail('The '.$attribute.' cannot be a common keyword.');
//                    }
//                },
//            ],
            'fullname' => ['required', 'string'],
            'email' => ['nullable', 'email', 'unique:App\Models\User,email'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
            'gender' => ['required', new Enum(Gender::class)],
            'password' => ['required', 'string', 'confirmed'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'area_id' => ['required', 'exists:areas,id'],
            'feature_image' => ['required', 'string'],
            'notification_preference' => ['nullable ', new Enum(AutoNotification::class)],
        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
//            'username' => [
//                'required',
//                'string', 'min:6', 'max:50',
//                'unique:App\Models\User,username,'.$this->id,
//                'regex:/^[A-Za-z0-9_-]+$/',
//                function ($attribute, $value, $fail) {
//                    if (in_array(strtolower($value), ['admin', 'user', 'password'])) {
//                        $fail('The '.$attribute.' cannot be a common keyword.');
//                    }
//                },
//            ],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email,'.$this->id],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone,'.$this->id],
            'gender' => ['required', new Enum(Gender::class)],
            'password' => ['nullable', 'string', 'confirmed'],
            'feature_image' => ['required', 'string'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'roles' => ['required', new Enum(UserRole::class)],
            'area_id' => ['required', 'exists:areas,id'],
            'notification_preference' => ['nullable ', new Enum(AutoNotification::class)],
        ];
    }
}
