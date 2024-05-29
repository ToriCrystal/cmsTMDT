<?php

namespace App\Api\V1\Http\Requests\Cart;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Api\V1\Repositories\Area\AreaRepository;
use App\Api\V1\Rules\Area\CoordinateInArea;
use App\Api\V1\Rules\Cart\ValidCartItemIds;
use App\Enums\Area\AreaStatus;

class CartItemRequest extends BaseRequest
{
    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet(): array
    {
        return [

        ];
    }

    protected function methodPost(): array
    {
        $areas = $this->areaRepository->getBy(['status' => AreaStatus::On]);
        $areaRule = new CoordinateInArea($areas);

        return [
            'cart_id' => 'required|exists:carts,id',
            'cart_item_ids' => ['required', 'array', new ValidCartItemIds($this->input('cart_id'))],
            'pickup_address' => ['nullable'],
            'coordinates' => ['required', $areaRule],

        ];
    }

    public function all($keys = null): array
    {
        $data = parent::all($keys);
        $data['coordinates'] = ['lat' => floatval($this->input('lat')), 'lng' => floatval($this->input('lng'))];
        return $data;
    }

    protected function methodPut(): array
    {
        return [
            'id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1',
        ];
    }

    protected function methodDelete(): array
    {
        return [
            'id' => 'required|exists:carts,id',
        ];
    }
}
