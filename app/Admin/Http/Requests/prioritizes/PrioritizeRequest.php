<?php

namespace App\Admin\Http\Requests\prioritizes;

use App\Admin\Http\Requests\BaseRequest;



class PrioritizeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [

            'day' => ['required', 'numeric'],
           

        ];
    }

    protected function methodPut()
    {
        return [
          

        ];
    }
}

