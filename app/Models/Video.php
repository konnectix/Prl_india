<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'video_type',
        'video_url',
        'video_file',
        'thumbnail',
        'youtube_id',
        'duration',
        'alt_text',
        'tags',
        'sort_order',
        'is_active',
        'is_featured',
        'views_count'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'tags' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title);
            }
            
            // Extract YouTube ID if it's a YouTube URL
            if ($video->video_type === 'youtube' && $video->video_url) {
                $video->youtube_id = self::extractYouTubeId($video->video_url);
            }
        });

        static::updating(function ($video) {
            if ($video->isDirty('title') && empty($video->slug)) {
                $video->slug = Str::slug($video->title);
            }
            
            // Extract YouTube ID if it's a YouTube URL
            if ($video->video_type === 'youtube' && $video->video_url) {
                $video->youtube_id = self::extractYouTubeId($video->video_url);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(VideoCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function getFullVideoUrlAttribute()
    {
        if ($this->video_type === 'upload' && $this->video_file) {
            return asset('storage/' . $this->video_file);
        }
        return $this->video_url;
    }

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        
        // Auto-generate YouTube thumbnail
        if ($this->video_type === 'youtube' && $this->youtube_id) {
            return "https://img.youtube.com/vi/{$this->youtube_id}/maxresdefault.jpg";
        }
        
        return asset('frontend/assets/images/project/project-1.jpg');
    }

    public function getEmbedUrlAttribute()
    {
        if ($this->video_type === 'youtube' && $this->youtube_id) {
            return "https://www.youtube.com/embed/{$this->youtube_id}";
        }
        
        if ($this->video_type === 'vimeo') {
            $vimeoId = $this->extractVimeoId($this->video_url);
            if ($vimeoId) {
                return "https://player.vimeo.com/video/{$vimeoId}";
            }
        }
        
        return $this->full_video_url;
    }

    public static function extractYouTubeId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    public function extractVimeoId($url)
    {
        $pattern = '/(?:vimeo\.com\/)([0-9]+)/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
