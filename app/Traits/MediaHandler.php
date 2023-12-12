<?php

namespace App\Traits;

use App\Enums\StorageDiskType;
use Illuminate\Http\UploadedFile;
use App\Models\Media;
use App\Models\User;
use App\Repositories\Media\MediaRepository;
use App\Services\Media\MediaStorageService;
use Illuminate\Database\Eloquent\Model;

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
        $mediaStorage = new MediaStorageService($disk);
        $uploadedMedia = $mediaStorage->upload($file, $directory, $width, $height);
        $media = app(MediaRepository::class)->create($user, [
            'name' => $file->getClientOriginalName(),
            // 'type' => $file->getMimeType(),
            'path' => $uploadedMedia['path'],
            'url' => $uploadedMedia['url'],
            'extension' => $file->getClientOriginalExtension(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'storage' => $disk
        ]);
        return $media;
    }

    /**
     * Delete media file.
     * 
     * @param Media $media
     * @return void
     */
    protected function deleteMediaFile(Media $media): void
    {
        $mediaStorage = new MediaStorageService($media->storage);
        $mediaStorage->delete($media->path);
        $media->delete();
    }
}

