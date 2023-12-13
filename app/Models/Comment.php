<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'admin_id',
        'parent_id',
        'content',
        'status'
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'status' => CommentStatus::class,
    ];

    /**
     * Get the post that owns the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user that owns the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin that owns the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the parent comment that owns the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id')->withDefault();
    }

    /**
     * Get the replies comments that owns the comment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Scope a query to only include approved comments.
     */
    public function scopeApproved(Builder $query)
    {
        return $query->where('status', CommentStatus::APPROVED);
    }

    /**
     * Scope a query to only include rejected comments.
     */
    public function scopeRejected(Builder $query)
    {
        return $query->where('status', CommentStatus::REJECTED);
    }

    /**
     * Scope a query to only include parent comments.
     */
    public function scopeParent(Builder $query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope a query to only include pending comments.
     */
    public function scopePending(Builder $query)
    {
        return $query->where('status', CommentStatus::PENDING);
    }
}
