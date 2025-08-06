<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EsgCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'banner_image',
        'color',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Automatically generate slug when creating/updating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
        
        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relationships
    public function articles()
    {
        return $this->hasMany(EsgArticle::class, 'category_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'desc')->orderBy('name', 'asc');
    }

    // Accessors
    public function getBannerImageUrlAttribute()
    {
        if ($this->banner_image) {
            if (filter_var($this->banner_image, FILTER_VALIDATE_URL)) {
                return $this->banner_image;
            }
            return Storage::url($this->banner_image);
        }
        return asset('frontend/assets/images/background/page-title.jpg');
    }

    public function getFullBannerImageUrlAttribute()
    {
        if ($this->banner_image) {
            if (filter_var($this->banner_image, FILTER_VALIDATE_URL)) {
                return $this->banner_image;
            }
            return url(Storage::url($this->banner_image));
        }
        return asset('frontend/assets/images/background/page-title.jpg');
    }

    // Helper methods
    public function getActiveArticlesCount()
    {
        return $this->articles()->where('is_active', true)->count();
    }
}
