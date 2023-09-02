<?php

namespace App\Repositories\Media;

use App\Abstracts\BaseCrudRepository;
use App\Models\Media;
use App\Contracts\Repositories\MediaRepositoryInterface;
use App\Models\User;

class MediaRepository extends BaseCrudRepository implements MediaRepositoryInterface
{
    public function __construct(Media $model)
    {
        parent::__construct($model);
    }

    /**
     * Create a media file.
     * 
     * @param ?User $user|null
     * @param array $data
     * @return Media
     */
    public function create(?User $user, array $data): Media
    {
        return $this->model->create([
            'user_id' => $user->id ?? null,
            'name' => $data['name'],
            // 'type' => $data['type'],
            'path' => $data['path'],
            'url' => $data['url'],
            'extension' => $data['extension'],
            'mime_type' => $data['mime_type'],
            'storage' => $data['storage'],
        ]);
    }
}
