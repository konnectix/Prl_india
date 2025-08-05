<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'image_path',
        'image_url',
        'alt_text',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        if ($this->image_path) {
            return Storage::url($this->image_path);
        }
        
        return null;
    }

    public function getFullImageUrlAttribute()
    {
        if ($this->image_url && filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }
        
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        
        return null;
    }
}
