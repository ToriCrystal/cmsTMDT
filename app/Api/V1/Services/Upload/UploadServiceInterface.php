<?php

namespace App\Api\V1\Services\Upload;

use Illuminate\Http\Request;

interface UploadServiceInterface
{

    /**
     * Execute the file upload process.
     *
     * @param Request $request
     * @return mixed
     */
    public function upload(Request $request): mixed;


}
