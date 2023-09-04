<?php

namespace App\Contracts\Services;

use Illuminate\Http\UploadedFile;

interface MediaStorageServiceInterface
{
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
    public function upload(UploadedFile $file, string $directory, int $width, int $height, ?string $filename = null): array;

    /**
     * Delete media file.
     * 
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool;
}