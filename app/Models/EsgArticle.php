<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EsgArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'category_id',
        'featured_image',
        'banner_image',
        'images',
        'meta_description',
        'meta_keywords',
        'sort_order',
        'is_featured',
        'is_active',
        'published_at',
        'view_count'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'images' => 'array',
        'sort_order' => 'integer',
        'view_count' => 'integer'
    ];

    // Automatically generate slug when creating/updating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if (empty($article->published_at)) {
                $article->published_at = now();
            }
        });
        
        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(EsgCategory::class, 'category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'desc')
                    ->orderBy('published_at', 'desc');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Accessors
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }
            return Storage::url($this->featured_image);
        }
        return asset('frontend/assets/images/news/default-news.jpg');
    }

    public function getFullFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }
            return url(Storage::url($this->featured_image));
        }
        return asset('frontend/assets/images/news/default-news.jpg');
    }

    public function getBannerImageUrlAttribute()
    {
        if ($this->banner_image) {
            if (filter_var($this->banner_image, FILTER_VALIDATE_URL)) {
                return $this->banner_image;
            }
            return Storage::url($this->banner_image);
        }
        return $this->category ? $this->category->banner_image_url : asset('frontend/assets/images/background/page-title.jpg');
    }

    public function getFullBannerImageUrlAttribute()
    {
        if ($this->banner_image) {
            if (filter_var($this->banner_image, FILTER_VALIDATE_URL)) {
                return $this->banner_image;
            }
            return url(Storage::url($this->banner_image));
        }
        return $this->category ? $this->category->full_banner_image_url : asset('frontend/assets/images/background/page-title.jpg');
    }

    public function getExcerptAttribute()
    {
        if ($this->short_description) {
            return $this->short_description;
        }
        return Str::limit(strip_tags($this->content), 150);
    }

    public function getReadingTimeAttribute()
    {
        $wordsPerMinute = 200;
        $wordCount = str_word_count(strip_tags($this->content));
        return max(1, ceil($wordCount / $wordsPerMinute));
    }

    // Helper methods
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : '';
    }

    public function getContentImagesAttribute()
    {
        if ($this->images && is_array($this->images)) {
            return collect($this->images)->map(function ($image) {
                if (filter_var($image, FILTER_VALIDATE_URL)) {
                    return $image;
                }
                return Storage::url($image);
            })->toArray();
        }
        return [];
    }
}
