<?php

namespace App\Api\V1\Http\Resources\Transaction;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'driver_id' => $this->driver_id,
            'order_id' => $this->order_id,
            'transaction_code' => $this->transaction_code,
            'amount' => $this->amount,
            'description' => $this->description,
            'feature_image' => $this->feature_image,
            'gallery' => $this->gallery ? json_decode($this->gallery) : null,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
