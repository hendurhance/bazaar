<?php

namespace App\Observers;

use App\Models\Media;
use Illuminate\Support\Facades\Log;

class MediaObserver
{
    /**
     * Handle the Media "created" event.
     */
    public function created(Media $media): void
    {
        Log::info('Media created: ' . $media->id);
    }

    /**
     * Handle the Media "updated" event.
     */
    public function updated(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "deleted" event.
     */
    public function deleted(Media $media): void
    {
        Log::info('Media deleted: ' . $media->id);
        @unlink(storage_path('app/' . $media->path));
    }

    /**
     * Handle the Media "restored" event.
     */
    public function restored(Media $media): void
    {
        //
    }

    /**
     * Handle the Media "force deleted" event.
     */
    public function forceDeleted(Media $media): void
    {
        Log::info('Media deleted: ' . $media->id);
        @unlink(storage_path('app/' . $media->path));
    }
}
