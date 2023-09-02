<?php

namespace App\Contracts\Services;

use Illuminate\Http\UploadedFile;

interface FileInterface
{
    /**
     * Upload a file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string
     */
    public function upload(UploadedFile $file, string $path): string;

    /**
     * Delete a file.
     * 
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool;
}