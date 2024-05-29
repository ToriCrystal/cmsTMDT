<?php

namespace App\Api\V1\Http\Controllers\Upload;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Upload\UploadRequest;
use App\Api\V1\Services\Upload\UploadServiceInterface;
use Illuminate\Http\JsonResponse;


/**
 * @group Upload
 */
class UploadController extends Controller
{

    protected UploadServiceInterface $uploadService;

    public function __construct(UploadServiceInterface $uploadService)
    {
        parent::__construct();
        $this->uploadService = $uploadService;
    }

    public function uploadImage(UploadRequest $request): JsonResponse
    {
        $response = $this->uploadService->upload($request);
        return response()->json([
            'message' => 'Image uploaded successfully.',
            'path' => $response
        ]);
    }


}
