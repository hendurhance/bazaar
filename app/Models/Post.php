<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory, HasMedia, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'featured_image_id',
        'is_published',
        'tags',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
    ];

    /**
     * The attributes that should be appended.
     *
     * @var array
     */
    protected $appends = [
        'featured_image_url',
    ];

    /**
     * Get the featured image url.
     *
     * @return string|null
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featuredImage?->url;
    }

    /**
     * Get the admin that owns the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the featured image that owns the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    /**
     * Get the comments for the post.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get related posts.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relatedPosts(): HasMany
    {
        return $this->hasMany(Post::class, 'admin_id', 'admin_id')
            ->where('id', '!=', $this->id)
            ->published()
            ->orWhereJsonContains('tags', $this->tags)
            ->orderBy('created_at', 'desc')
            ->limit(3);
    }

    /**
     * Scope a query to only include published posts.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

}
