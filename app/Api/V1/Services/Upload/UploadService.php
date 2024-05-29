<?php

namespace App\Api\V1\Services\Upload;

use App\Admin\Services\File\FileService;
use Illuminate\Http\Request;

class UploadService implements UploadServiceInterface
{
    protected $data;

    protected $service;

    protected $instance;

    public function __construct(FileService $fileService)
    {
        $this->service = $fileService;
    }

    public function upload(Request $request): mixed
    {
        $this->data = $request->validated();
        $image = $request->file('image');

        if (!$image->isValid()) {
            return response()->json(['error' => 'Invalid image upload.'], 422);
        }

        $upload = $this->service->setFolder('images')
            ->setFile($image)
            ->upload();
        if ($upload->getInstance() == null) {
            return response()->json(['error' => 'Failed to store the image.'], 500);
        }

        $storedImagePath = $upload->getInstance();
        $storedImagePath = preg_replace('#(?<!:)/{2,}#', '/', $storedImagePath);
        if ($storedImagePath[0] !== '/') {
            $storedImagePath = '/' . $storedImagePath;
        }
        return $storedImagePath;

    }
}
