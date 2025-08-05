<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        try {
            // Debug logging
            Log::info('Gallery Photo Store Method Called');
            Log::info('Request Data: ', $request->all());
            
            // Custom validation to ensure either image or image_url is provided
            $request->validate([
                'category_id' => 'required|exists:gallery_categories,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'alt_text' => 'nullable|string|max:255',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            // Additional validation for image/URL
            Log::info('Image file present: ' . ($request->hasFile('image') ? 'YES' : 'NO'));
            Log::info('Image URL value: ' . ($request->image_url ?? 'EMPTY'));
            
            if (!$request->hasFile('image') && empty($request->image_url)) {
                Log::info('Both image file and URL are empty - returning error');
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['image' => 'Please upload an image file or provide an image URL.']);
            }

            if ($request->hasFile('image')) {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);
            }

            if (!empty($request->image_url)) {
                $request->validate([
                    'image_url' => 'url'
                ]);
            }

            Log::info('Validation passed');

            $data = $request->only(['category_id', 'title', 'description', 'alt_text', 'sort_order']);
            $data['is_active'] = $request->has('is_active');

            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('gallery', 'public');
                $data['image_path'] = $imagePath;
                $data['image_url'] = null;
            } elseif ($request->image_url) {
                $data['image_path'] = null;
                $data['image_url'] = $request->image_url;
            }

            Log::info('Processed Data: ', $data);

            $photo = GalleryPhoto::create($data);
            
            Log::info('Photo Created: ', ['id' => $photo->id, 'title' => $photo->title]);

            return redirect()->route('admin.gallery.photos.index')
                ->with('success', 'Gallery photo added successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Gallery Photo Validation Error: ', $e->errors());
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Gallery Photo Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while adding the photo: ' . $e->getMessage());
        }
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
        ]);

        $data = $request->only([
            'category_id', 'title', 'description', 'image_url', 'alt_text', 'sort_order'
        ]);
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
