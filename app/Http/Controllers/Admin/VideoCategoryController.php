<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoCategoryController extends Controller
{
    public function index()
    {
        $categories = VideoCategory::withCount('videos')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.video.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.video.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:video_categories,name',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        
        // Set default sort order if not provided
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = VideoCategory::max('sort_order') + 1;
        }

        VideoCategory::create($data);

        return redirect()->route('admin.video.categories.index')
            ->with('success', 'Video category created successfully.');
    }

    public function show(VideoCategory $category)
    {
        $category->load(['videos' => function($query) {
            $query->orderBy('created_at', 'desc')->take(10);
        }]);

        return view('admin.video.categories.show', compact('category'));
    }

    public function edit(VideoCategory $category)
    {
        return view('admin.video.categories.edit', compact('category'));
    }

    public function update(Request $request, VideoCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:video_categories,name,' . $category->id,
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        $category->update($data);

        return redirect()->route('admin.video.categories.index')
            ->with('success', 'Video category updated successfully.');
    }

    public function destroy(VideoCategory $category)
    {
        // Check if category has videos
        if ($category->videos()->count() > 0) {
            return redirect()->route('admin.video.categories.index')
                ->with('error', 'Cannot delete category that contains videos. Please move or delete videos first.');
        }

        $category->delete();

        return redirect()->route('admin.video.categories.index')
            ->with('success', 'Video category deleted successfully.');
    }
}
