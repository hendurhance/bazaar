<?php

namespace App\Services\Media;

use App\Abstracts\BaseMediaStorageService;
use App\Contracts\Services\MediaStorageServiceInterface;
use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class LocalStorage extends BaseMediaStorageService implements MediaStorageServiceInterface
{
public function __construct()
    {
        parent::__construct(StorageDiskType::LOCAL);
    }

    /**
     * Resize image.
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param int $width
     * @param int $height
     * @return void
     */
    protected function resizeImage(UploadedFile $file, string $directory, int $width, int $height): void
    {
        $image = Image::make($file->path());
        $directory = preg_replace('/^public/', '', $directory);
        $image->fit($width, $height, function ($constraint) {
            $constraint->upsize();
        })->save('storage'.$directory.'/'.$file->hashName());
    }
}
