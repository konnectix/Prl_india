<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::with('category');

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by video type
        if ($request->filled('video_type')) {
            $query->where('video_type', $request->video_type);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status == 'active');
        }

        $videos = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = VideoCategory::active()->ordered()->get();

        return view('admin.video.videos.index', compact('videos', 'categories'));
    }

    public function create(Request $request)
    {
        $categories = VideoCategory::active()->ordered()->get();
        $selectedCategory = $request->get('category');
        return view('admin.video.videos.create', compact('categories', 'selectedCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:video_categories,id',
            'video_type' => 'required|in:youtube,vimeo,upload,external',
            'youtube_url' => 'required_if:video_type,youtube|nullable|url',
            'vimeo_url' => 'required_if:video_type,vimeo|nullable|url',
            'external_url' => 'required_if:video_type,external|nullable|url',
            'video_file' => 'required_if:video_type,upload|nullable|file|mimes:mp4,avi,mov,wmv|max:102400', // 100MB max
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer|min:1',
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        // Handle video file upload
        if ($request->hasFile('video_file')) {
            $videoPath = $request->file('video_file')->store('videos', 'public');
            $data['video_path'] = $videoPath;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('video-thumbnails', 'public');
            $data['thumbnail_path'] = $thumbnailPath;
        }

        // Process URLs based on video type
        if ($data['video_type'] === 'youtube' && $data['youtube_url']) {
            $data['youtube_id'] = $this->extractYouTubeId($data['youtube_url']);
            $data['embed_url'] = "https://www.youtube.com/embed/{$data['youtube_id']}";
        } elseif ($data['video_type'] === 'vimeo' && $data['vimeo_url']) {
            $vimeoId = $this->extractVimeoId($data['vimeo_url']);
            $data['embed_url'] = "https://player.vimeo.com/video/{$vimeoId}";
        } elseif ($data['video_type'] === 'external' && $data['external_url']) {
            $data['embed_url'] = $data['external_url'];
        } elseif ($data['video_type'] === 'upload' && isset($data['video_path'])) {
            $data['embed_url'] = Storage::url($data['video_path']);
        }

        Video::create($data);

        return redirect()->route('admin.video.videos.index')
            ->with('success', 'Video created successfully.');
    }

    public function show(Video $video)
    {
        $video->load('category');
        return view('admin.video.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        $categories = VideoCategory::active()->ordered()->get();
        return view('admin.video.videos.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:video_categories,id',
            'video_type' => 'required|in:youtube,vimeo,upload,external',
            'youtube_url' => 'required_if:video_type,youtube|nullable|url',
            'vimeo_url' => 'required_if:video_type,vimeo|nullable|url',
            'external_url' => 'required_if:video_type,external|nullable|url',
            'video_file' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:102400',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|integer|min:1',
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');

        // Handle video file upload
        if ($request->hasFile('video_file')) {
            // Delete old video file
            if ($video->video_path) {
                Storage::disk('public')->delete($video->video_path);
            }
            $videoPath = $request->file('video_file')->store('videos', 'public');
            $data['video_path'] = $videoPath;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($video->thumbnail_path) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }
            $thumbnailPath = $request->file('thumbnail')->store('video-thumbnails', 'public');
            $data['thumbnail_path'] = $thumbnailPath;
        }

        // Process URLs based on video type
        if ($data['video_type'] === 'youtube' && $data['youtube_url']) {
            $data['youtube_id'] = $this->extractYouTubeId($data['youtube_url']);
            $data['embed_url'] = "https://www.youtube.com/embed/{$data['youtube_id']}";
        } elseif ($data['video_type'] === 'vimeo' && $data['vimeo_url']) {
            $vimeoId = $this->extractVimeoId($data['vimeo_url']);
            $data['embed_url'] = "https://player.vimeo.com/video/{$vimeoId}";
        } elseif ($data['video_type'] === 'external' && $data['external_url']) {
            $data['embed_url'] = $data['external_url'];
        } elseif ($data['video_type'] === 'upload' && isset($data['video_path'])) {
            $data['embed_url'] = Storage::url($data['video_path']);
        }

        $video->update($data);

        return redirect()->route('admin.video.videos.index')
            ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video)
    {
        // Delete associated files
        if ($video->video_path) {
            Storage::disk('public')->delete($video->video_path);
        }
        if ($video->thumbnail_path) {
            Storage::disk('public')->delete($video->thumbnail_path);
        }

        $video->delete();

        return redirect()->route('admin.video.videos.index')
            ->with('success', 'Video deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'video_ids' => 'required|array',
            'video_ids.*' => 'exists:videos,id'
        ]);

        $videos = Video::whereIn('id', $request->video_ids)->get();
        
        foreach ($videos as $video) {
            // Delete associated files
            if ($video->video_path) {
                Storage::disk('public')->delete($video->video_path);
            }
            if ($video->thumbnail_path) {
                Storage::disk('public')->delete($video->thumbnail_path);
            }
            $video->delete();
        }

        return redirect()->route('admin.video.videos.index')
            ->with('success', count($request->video_ids) . ' videos deleted successfully.');
    }

    public function toggleFeatured(Video $video)
    {
        $video->update(['is_featured' => !$video->is_featured]);
        
        $status = $video->is_featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Video {$status} successfully.");
    }

    public function toggleStatus(Video $video)
    {
        $video->update(['is_active' => !$video->is_active]);
        
        $status = $video->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Video {$status} successfully.");
    }

    private function extractYouTubeId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }

    private function extractVimeoId($url)
    {
        $pattern = '/(?:vimeo\.com\/)([0-9]+)/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }
}
