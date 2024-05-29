<?php

namespace App\Api\V1\Http\Requests\Upload;

use App\Api\V1\Http\Requests\BaseRequest;

class UploadRequest extends BaseRequest
{

    protected function methodPost(): array
    {
        return [
            'image' => 'required|image|max:5000',
        ];
    }


}
