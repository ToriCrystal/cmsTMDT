<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;
use App\Enums\DefaultStatus;
use App\Enums\Product\StockStatus;
use Illuminate\Validation\Rules\Enum;


class ProductStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required', 'string'],
            'store_id' => ['required', 'exists:stores,id'],
            'category_id' => ['required', 'exists:store_categories,id'],
            'sku' => ['required', 'string'],
            'qty' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
            'price_selling' => ['nullable'],
            'price_promotion' => ['nullable'],
            'status' => ['required', new Enum(DefaultStatus::class)],
            'in_stock' => ['required', new Enum(StockStatus::class)],
//            'desc' => ['required', 'string'],
            'feature_image' => ['required', 'string'],

        ];
    }

    protected function methodPut()
    {
        return [
            'id'=>['required'],
            'name' => ['required', 'string'],
            'sku' => ['required', 'string'],
            'qty' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:1'],
            'price_selling' => ['nullable'],
            'price_promotion' => ['nullable'],
            'status' => ['required', new Enum(DefaultStatus::class)],
            'in_stock' => ['required', new Enum(StockStatus::class)],
            'desc' => ['required', 'string'],
            'feature_image' => ['required', 'string'],

        ];
    }
}

