<?php

namespace App\Admin\Http\Requests\UserDriver;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\Driver\AutoAccept;
use App\Enums\Driver\DriverStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rule;


class UserDriverRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost(): array
    {
        return [

            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('user_driver_info', 'user_id'),
            ],
            'id_card' => ['required', 'string', 'unique:user_driver_info,id_card'],
            'license_plate' => ['nullable', 'string', 'max:20'],
            'vehicle_company' => ['nullable', 'string', 'max:255'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_name' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:50'],
            'avatar' => ['required'],
            'address' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'auto_accept' => ['nullable ', new Enum(AutoAccept::class)],

        ];
    }

    protected function methodPut(): array
    {
        return [
            'id' => ['required', 'exists:App\Models\UserDriver,id'],
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('user_driver_info', 'user_id')->ignore($this->id),
            ],
            'id_card' => ['required', 'string', 'unique:user_driver_info,id_card,' . $this->id],
            'license_plate' => ['nullable', 'string', 'max:20'],
            'vehicle_company' => ['nullable', 'string', 'max:255'],
            'bank_name' => ['nullable', 'string', 'max:255'],
            'bank_account_name' => ['nullable', 'string', 'max:255'],
            'bank_account_number' => ['nullable', 'string', 'max:50'],
            'avatar' => ['required'],
            'address' => ['required'],
            'lat' => ['required'],
            'lng' => ['required'],
            'auto_accept' => ['nullable ', new Enum(AutoAccept::class)],
            'order_accepted' => ['required ', new Enum(DriverStatus::class)],

        ];
    }
    public function messages(): array
    {
        return [
            'user_id.unique' => __('This user has already registered as a driver.'),
        ];
    }
}
