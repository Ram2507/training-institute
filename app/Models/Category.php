<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = [
        'is_active',
        'title',
        'slug',
        'description',
        'thumbnail',
        'created_by',
        'canonical_url',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function blogs()
    {
        return $this->belongsToMany(\App\Models\Blog::class, 'blog_category');
    }
}
