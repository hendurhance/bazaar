<?php

namespace App\Traits;

use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use App\Models\User;
use App\Repositories\Media\MediaRepository;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

trait MediaHandler
{
    /**
     * Upload media files.
     * 
     * @param Model $model
     * @param array $files
     * @param StorageDiskType $disk
     * @param string $directory
     * @param User $user
     * @param int $width
     * @param int $height
     * @return void
     */
    public function uploadMedia(Model $model, array $files, StorageDiskType $disk, string $directory, int $width = 1024, int $height = 768, ?User $user = null): void
    {
        foreach ($files as $file) {
            $media = $this->storeMedia($file, $directory, $disk, $width, $height, $user);
            $model->media()->save($media);
        }
    }

    /**
     * Store media file.
     * 
     * @param UploadedFile $file
     * @param string $directory
     * @param StorageDiskType $disk
     * @param ?User $user|null
     * @param int $width
     * @param int $height
     * @return Media
     */
    protected function storeMedia(UploadedFile $file, string $directory, StorageDiskType $disk, int $width, int $height, ?User $user = null): Media
    {
        $path = $file->store($directory, ['disk' => strtolower($disk->label())]);
        $url = Storage::disk(strtolower($disk->value))->url($path);
        $this->resizeImage($file, $width, $height);
        $media = app(MediaRepository::class)->create($user, [
            'name' => $file->getClientOriginalName(),
            // 'type' => $file->getMimeType(),
            'path' => $path,
            'url' => $url,
            'extension' => $file->getClientOriginalExtension(),
            'mime_type' => $file->getMimeType(),
            'storage' => $disk
        ]);
        return $media;
    }

    /**
     * Resize image.
     * 
     * @param UploadedFile $file
     * @param int $width
     * @param int $height
     * @return void
     */
    protected function resizeImage(UploadedFile $file, int $width, int $height): void
    {
        $image = Image::make($file->path());
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save('storage/ad/' . $file->hashName());
    }

    /**
     * Delete media files.
     * 
     * @param Model $model
     * @param array $files
     * @return void
     */
    public function deleteMedia(Model $model, array $files): void
    {
        foreach ($files as $file) {
            $this->deleteMediaFile($file);
        }
    }

    /**
     * Delete media file.
     * 
     * @param Media $media
     * @return void
     */
    protected function deleteMediaFile(Media $media): void
    {
        Storage::disk($media->storage)->delete($media->path);
        $media->delete();
    }
}

