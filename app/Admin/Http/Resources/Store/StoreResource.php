<?php

namespace App\Admin\Http\Resources\Store;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'store_name' => $this->store_name,
            'store_phone' => $this->store_phone,
            'contact_name' => $this->contact_name,
            'address' => $this->address,
            'lng' => $this->lng,
            'lat' => $this->lat,
        ];
    }
}
