<?php

namespace App\Api\V1\Http\Requests\Product;

use App\Api\V1\Http\Requests\BaseRequest;

class ProductCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet(): array
    {
        return [
            'page' => 'required|integer',
            'limit' => 'sometimes|required|integer|min:1',
            'category_id' => 'required|exists:categories,id',
        ];
    }

}
