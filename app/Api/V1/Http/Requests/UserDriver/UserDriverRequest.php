<?php

namespace App\Api\V1\Http\Requests\UserDriver;

use App\Api\V1\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UserDriverRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [

        ];
    }

    protected function methodPost(): array
    {
        return [

            'area_id' => ['required', 'exists:areas,id'],
            'fullname' => ['required', 'string'],
            'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)/', 'unique:App\Models\User,phone'],
            'password' => ['required', 'string', 'confirmed'],
            'avatar' => 'nullable|url',
            'id_card' => 'required|string|max:50|unique:user_driver_info,id_card',
            'id_card_front' => 'nullable|url',
            'id_card_back' => 'nullable|url',
            'license_plate' => 'nullable|string|max:255',
            'vehicle_company' => 'nullable|string|max:255',
            'vehicle_registration_front' => 'nullable|url',
            'vehicle_registration_back' => 'nullable|url',
            'driver_license_front' => 'nullable|url',
            'driver_license_back' => 'nullable|url',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
        ];
    }


    protected function methodPut(): array
    {
        return [
            'avatar' => 'nullable|url',
            'id_card' => 'required|string|max:50|unique:user_driver_info,id_card,' . $this->id . ',id',            'id_card_front' => 'nullable|url',
            'id_card_back' => 'nullable|url',
            'license_plate' => 'nullable|string|max:255',
            'vehicle_company' => 'nullable|string|max:255',
            'vehicle_registration_front' => 'nullable|url',
            'vehicle_registration_back' => 'nullable|url',
            'driver_license_front' => 'nullable|url',
            'driver_license_back' => 'nullable|url',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_name' => 'nullable|string|max:255',
            'bank_account_number' => 'nullable|string|max:255',
        ];
    }


}
