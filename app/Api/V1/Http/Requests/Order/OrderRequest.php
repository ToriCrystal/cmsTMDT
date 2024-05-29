<?php

namespace App\Api\V1\Http\Requests\Order;

use App\Api\V1\Http\Requests\BaseRequest;
use App\Api\V1\Repositories\Area\AreaRepository;
use App\Api\V1\Rules\Area\CoordinateInArea;
use App\Enums\Area\AreaStatus;
use App\Enums\Payment\PaymentMethod;
use App\Enums\Shipping\ShippingMethod;
use Illuminate\Validation\Rules\Enum;

class OrderRequest extends BaseRequest
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
            'distance' => ['required'],
            'payment_method' => ['nullable'],
            'shipping_method' => ['required'],
            'sub_total' => ['required'],

        ];
    }

    protected function methodPost(): array
    {
        $areas = $this->areaRepository->getBy(['status' => AreaStatus::On]);
        $areaRule = new CoordinateInArea($areas);

        return [
            'customer_id' => 'required|exists:users,id',
            'store_id' => 'required|exists:stores,id',
            'pickup_address' => ['nullable'],
            'coordinates' => ['required', $areaRule],
            'total' => ['required', 'numeric'],
            'transport_fee' => 'nullable|numeric',
            'sub_total' => ['required', 'numeric'],
            'cart_ids' => ['required', 'array'],
            'cart_ids.*' => ['required', 'exists:cart_items,id'],
            'shipping_method' => ['required', new Enum(ShippingMethod::class)],
            'payment_method' => ['nullable', new Enum(PaymentMethod::class)],
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

        ];
    }

    protected function methodPatch(): array
    {
        return [
            'id' => 'required|integer|exists:orders,id',
            'status' => 'required'
        ];
    }

    protected function methodDelete(): array
    {
        return [

        ];
    }
}
