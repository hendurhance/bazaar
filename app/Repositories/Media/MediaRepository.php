<?php

namespace App\Repositories\Media;

use App\Abstracts\BaseCrudRepository;
use App\Models\Media;
use App\Contracts\Repositories\MediaRepositoryInterface;
use App\Exceptions\MediaException;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

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
            'size' => $data['size'],
            'extension' => $data['extension'],
            'mime_type' => $data['mime_type'],
            'storage' => $data['storage'],
        ]);
    }

    /**
     * Get all media for admin.
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllMediaForAdmin(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['user:id,name,username,avatar'])
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where(function ($query) use ($filters) {
                        $query->where('name', 'like', '%' . $filters['search'] . '%')
                            ->orWhere('user_id', $filters['search'])
                            ->orWhereHas('user', function ($query) use ($filters) {
                                $query->where('name', 'like', '%' . $filters['search'] . '%')
                                    ->orWhere('username', 'like', '%' . $filters['search'] . '%');
                            });
                    });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'search' => $filters['search'] ?? null,
            ]);
    }

    /**
     * Get media for admin.
     * 
     * @param string $id
     * @return Media
     */
    public function getMediaForAdmin(string $id): \App\Models\Media
    {
        return $this->model->query()->with(['user:id,name,username,avatar'])
            ->where('id', $id)
            ->firstOr(function () {
                throw new MediaException('Media not found.');
            });
    }

    /**
     * Delete media.
     * 
     * @param string $id
     * @return void
     */
    public function deleteMedia(string $id): void
    {
        $media = $this->model->query()->where('id', $id)->firstOr(function () {
            throw new MediaException('Media not found.');
        });
        $media->delete();
    }
}
