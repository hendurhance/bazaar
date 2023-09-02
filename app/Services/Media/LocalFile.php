<?php

namespace App\Services\File;

use App\Abstracts\BaseFile;
use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LocalFile extends BaseFile
{

    protected string $disk = 'local';

    /**
     * Create a new file instance.
     * 
     * @return void
     */
    public function __construct()
    {
        parent::__construct($this->disk);
    }

    /**
     * Upload a file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @param int $width
     * @param int $height
     * @return string
     */
    public function upload(UploadedFile $file, string $directory, int $width = 640, int $height = 480): string
    {
        $path = $this->store($file, $directory);
        $this->resize($path, $width, $height);
        return $path;
    }

    /**
     * Store a file.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    public function store(UploadedFile $file, string $directory): string
    {
        return Storage::disk($this->disk)->putFile($directory, $file);
    }

    /**
     * Resize a file.
     * 
     * @param string $path
     * @param int $width
     * @param int $height
     * @return void
     */
    public function resize(string $path, int $width, int $height):void
    {
        $image = Image::make(Storage::disk($this->disk)->path($path));
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image->save();
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