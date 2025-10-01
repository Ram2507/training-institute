<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Blog extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'description',
        'thumbnail', 'featured_image',
        'meta_title', 'meta_description',
        'published_at', 'status', 'is_featured',
        'view_count', 'reading_time',
        'video_url', 'location',
        'created_by',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
        'view_count'   => 'integer',
        'reading_time' => 'integer',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'blog_category');
    }
}
