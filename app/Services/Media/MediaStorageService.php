<?php

namespace App\Services\Media;

use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;

final class MediaStorageService
{
    protected $storage;

    public function __construct(StorageDiskType $disk)
    {
        match ($disk) {
            StorageDiskType::S3 => $this->storage = new S3Storage(),
            StorageDiskType::LOCAL => $this->storage = new LocalStorage(),
            default => throw new \Exception('Invalid storage disk type.')
        };
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
        return $this->storage->upload($file, $directory, $width, $height, $filename);
    }

    /**
     * Delete media file.
     * 
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        return $this->storage->delete($path);
    }
}