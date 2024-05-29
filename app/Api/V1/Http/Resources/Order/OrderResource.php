<?php

namespace App\Api\V1\Http\Resources\Order;

use App\Admin\Http\Resources\Store\StoreResource;
use App\Api\V1\Http\Resources\Auth\AuthResource;
use App\Api\V1\Http\Resources\UserDriver\UserDriverResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     * */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'customer_id' => $this->customer_id,
            'driver_id' => $this->driver_id,
            'store_id' => $this->store_id,
            'customer' => new AuthResource($this->customer),
            'driver' => new UserDriverResource($this->driver),
            'store' => new StoreResource($this->store),
            'pickup_address' => $this->pickup_address,
            'destination_address' => $this->destination_address,
            'shipping_address' => $this->shipping_address,
            'shipping_method' => $this->shipping_method,
            'payment_method' => $this->payment_method,
            'sub_total' => $this->sub_total,
            'transport_fee' => $this->transport_fee,
            'total' => $this->total,
            'status' => $this->status,
            'system_revenue' => $this->system_revenue,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
