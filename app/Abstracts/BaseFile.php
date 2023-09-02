<?php

namespace App\Abstracts;

use App\Contracts\Services\FileInterface;
use Illuminate\Http\UploadedFile;

abstract class BaseFile implements FileInterface
{
    protected string $disk;

    /**
     * Create a new file instance.
     * 
     * @param string $disk
     * @return void
     */
    public function __construct(string $disk)
    {
        $this->disk = $disk;
    }

    /**
     * Get the file disk.
     * 
     * @return string
     */
    public function getDisk(): string
    {
        return $this->disk;
    }

    /**
     * Upload a file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string
     */
    abstract public function upload(UploadedFile $file, string $path): string;

    /**
     * Delete a file.
     * 
     * @param string $path
     * @return bool
     */
    abstract public function delete(string $path): bool;
    
}