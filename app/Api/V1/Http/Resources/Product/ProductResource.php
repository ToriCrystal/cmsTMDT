<?php

namespace App\Api\V1\Http\Resources\Product;

use App\Admin\Http\Resources\Store\StoreResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'category_id' => $this->category_id,
            'store' => new StoreResource($this->store),
            'price' => $this->price,
            'sku' => $this->sku,
            'in_stock' => $this->in_stock,
            'feature_image' => $this->feature_image,
            'status' => $this->status,
        ];
    }
}
