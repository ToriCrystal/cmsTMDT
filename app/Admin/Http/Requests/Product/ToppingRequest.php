<?php

namespace App\Admin\Http\Requests\Product;

use App\Admin\Http\Requests\BaseRequest;
// use App\Enums\DefaultStatus;
// use App\Enums\Product\StockStatus;
// use Illuminate\Validation\Rules\Enum;


class ToppingRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:191',
            'type' => 'required|integer',
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => 'required',
            'store_id' => 'required|exists:stores,id',
            'name' => 'required|string|max:191',
            'type' => 'required|integer',

        ];
    }
}

