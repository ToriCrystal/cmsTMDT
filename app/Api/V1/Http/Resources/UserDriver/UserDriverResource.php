<?php

namespace App\Api\V1\Http\Resources\UserDriver;

use App\Api\V1\Http\Resources\Auth\AuthResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'avatar' => $this->avatar,
            'id_card' => $this->id_card,
            'id_card_front' => $this->id_card_front,
            'id_card_back' => $this->id_card_back,
            'license_plate' => $this->license_plate,
            'vehicle_company' => $this->vehicle_company,
            'vehicle_registration_front' => $this->vehicle_registration_front,
            'vehicle_registration_back' => $this->vehicle_registration_back,
            'driver_license_front' => $this->driver_license_front,
            'driver_license_back' => $this->driver_license_back,
            'bank_name' => $this->bank_name,
            'bank_account_name' => $this->bank_account_name,
            'bank_account_number' => $this->bank_account_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new AuthResource($this->whenLoaded('user')),
        ];
    }

}
