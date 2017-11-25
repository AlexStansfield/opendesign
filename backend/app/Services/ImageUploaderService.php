<?php

namespace App\Services;

use Intervention\Image\ImageManager;

class ImageUploaderService
{
    const PATH_MOCKS = '/uploads/design-mocks/';
    const PATH_BRIEF = '/uploads/brief-media/';

    /**
     * @var ImageManager
     */
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * @param string $base64
     * @param string $uploadPath
     * @param string|null $filename
     * @param string $extension
     * @return \Intervention\Image\Image
     */
    public function storeBase64($base64, $uploadPath, $filename = null, $extension = 'jpg')
    {
        if (null === $filename) {
            $filename = uniqid('mock') . '.' . $extension;
        }

        $filePath = $uploadPath . $filename;

        $image = $this->imageManager->make(base64_decode($base64))->save(public_path($filePath));

        return $image;
    }
}
