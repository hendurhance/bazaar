<?php

namespace App\Services\Media;

use App\Abstracts\BaseMediaStorageService;
use App\Contracts\Services\MediaStorageServiceInterface;
use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class S3Storage extends BaseMediaStorageService implements MediaStorageServiceInterface
{
    protected StorageDiskType $disk;

    public function __construct()
    {
        parent::__construct(StorageDiskType::S3);
    }

    /**
     * Resize image for s3 aws
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param int $width
     * @param int $height
     * @return void
     */
    protected function resizeImage(UploadedFile $file, string $directory, int $width, int $height): void
    {
        $image = Image::make($file->getRealPath());
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->stream();
        Storage::disk(strtolower($this->disk->label()))->put($file->getFilename(), $image);
    }
}
