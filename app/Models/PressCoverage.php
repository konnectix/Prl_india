<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PressCoverage extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'excerpt',
        'content',
        'featured_image',
        'external_url',
        'source',
        'published_date',
        'author',
        'tags',
        'sort_order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_date' => 'date',
        'tags' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(PressCategory::class, 'category_id');
    }

    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return Storage::url($this->featured_image);
        }
        return null;
    }

    public function getFullFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return null;
    }

    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_date ? $this->published_date->format('M d, Y') : null;
    }

    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        if ($this->content) {
            return Str::limit(strip_tags($this->content), 150);
        }
        
        return null;
    }

    public function getTagsListAttribute()
    {
        return $this->tags ? implode(', ', $this->tags) : '';
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('published_date', '<=', Carbon::today());
    }
}
