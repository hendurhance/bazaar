<?php

namespace App\Abstracts;

use App\Contracts\Services\MediaStorageServiceInterface;
use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class BaseMediaStorageService implements MediaStorageServiceInterface
{
    protected StorageDiskType $disk;

    public function __construct(StorageDiskType $disk)
    {
        $this->disk = $disk;
    }

    /**
     * Upload media file.
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param int $width
     * @param int $height
     * @param ?string $filename
     * @return array
     */
    public function upload(UploadedFile $file, string $directory, int $width, int $height, ?string $filename = null): array
    {
        $path = $file->store($directory, ['disk' => strtolower($this->disk->label())]);
        $url = Storage::disk(strtolower($this->disk->label()))->url($path);
        $this->resizeImage($file, $directory, $width, $height);
        return ['path' => $path, 'url' => $url];
    }

    abstract protected function resizeImage(UploadedFile $file, string $directory, int $width, int $height): void;

    /**
     * Delete media file.
     * 
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        return Storage::disk(strtolower($this->disk->label()))->delete($path);
    }
}
