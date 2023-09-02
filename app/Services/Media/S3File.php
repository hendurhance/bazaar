<?php

namespace App\Services\File;

use App\Abstracts\BaseFile;
use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class S3File extends BaseFile
{
    protected string $disk = 's3';

    public function __construct()
    {
        parent::__construct($this->disk);
    }

    /**
     * Upload a file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string
     */
    public function upload(UploadedFile $file, string $path, int $width = 640, int $height = 480): string
    {
        $path = $this->store($file, $path);
        $this->resize($path, $width, $height);
        return $path;
    }

    /**
     * Store a file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $path
     * @return string
     */
    public function store(UploadedFile $file, string $path): string
    {
        return Storage::disk($this->disk)->put($path, $file);
    }

    /**
     * Resize a file.
     * 
     * @param string $path
     * @param int $width
     * @param int $height
     * @return void
     */
    public function resize(string $path, int $width, int $height): void
    {
        $image = Image::make(Storage::disk($this->disk)->get($path));
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::disk($this->disk)->put($path, $image->encode());
    }

    /**
     * Delete a file.
     * 
     * @param string $path
     * @return bool
     */
    public function delete(string $path): bool
    {
        return Storage::disk($this->disk)->delete($path);
    }
    
}