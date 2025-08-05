<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryCategory::where('is_active', true)->orderBy('sort_order')->get();
        
        $query = GalleryPhoto::with('category');
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        $photos = $query->orderBy('category_id')->orderBy('sort_order')->paginate(12);
        
        return view('admin.gallery.photos.index', compact('photos', 'categories'));
    }

    public function create()
    {
        $categories = GalleryCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.gallery.photos.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required_without:image_url|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'required_without:image|url',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $data['image_path'] = $imagePath;
            $data['image_url'] = null;
        } elseif ($request->image_url) {
            $data['image_path'] = null;
        }

        GalleryPhoto::create($data);

        return redirect()->route('admin.gallery.photos.index')
            ->with('success', 'Gallery photo added successfully.');
    }

    public function show(GalleryPhoto $photo)
    {
        $photo->load('category');
        return view('admin.gallery.photos.show', compact('photo'));
    }

    public function edit(GalleryPhoto $photo)
    {
        $categories = GalleryCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.gallery.photos.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, GalleryPhoto $photo)
    {
        $request->validate([
            'category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            
            $imagePath = $request->file('image')->store('gallery', 'public');
            $data['image_path'] = $imagePath;
            $data['image_url'] = null;
        } elseif ($request->image_url && $request->image_url !== $photo->image_url) {
            // Delete old image if switching to URL
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            $data['image_path'] = null;
        }

        $photo->update($data);

        return redirect()->route('admin.gallery.photos.index')
            ->with('success', 'Gallery photo updated successfully.');
    }

    public function destroy(GalleryPhoto $photo)
    {
        // Delete image file if exists
        if ($photo->image_path) {
            Storage::disk('public')->delete($photo->image_path);
        }
        
        $photo->delete();
        
        return redirect()->route('admin.gallery.photos.index')
            ->with('success', 'Gallery photo deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'photo_ids' => 'required|array',
            'photo_ids.*' => 'exists:gallery_photos,id'
        ]);

        $photos = GalleryPhoto::whereIn('id', $request->photo_ids)->get();
        
        foreach ($photos as $photo) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
            $photo->delete();
        }

        return redirect()->route('admin.gallery.photos.index')
            ->with('success', count($request->photo_ids) . ' photos deleted successfully.');
    }
}
