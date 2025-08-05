<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryPhoto;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = GalleryCategory::where('is_active', true)
            ->withCount('activePhotos')
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = null;
        $photos = collect();

        if ($request->has('category') && $request->category) {
            $selectedCategory = GalleryCategory::where('slug', $request->category)
                ->where('is_active', true)
                ->first();
                
            if ($selectedCategory) {
                $photos = $selectedCategory->activePhotos()
                    ->paginate(12)
                    ->appends($request->query());
            }
        } else {
            // Show first category by default
            $selectedCategory = $categories->first();
            if ($selectedCategory) {
                $photos = $selectedCategory->activePhotos()
                    ->paginate(12);
            }
        }

        return view('frontend.gallery.index', compact('categories', 'selectedCategory', 'photos'));
    }

    public function category($slug)
    {
        $categories = GalleryCategory::where('is_active', true)
            ->withCount('activePhotos')
            ->orderBy('sort_order')
            ->get();

        $selectedCategory = GalleryCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $photos = $selectedCategory->activePhotos()->paginate(12);

        return view('frontend.gallery.index', compact('categories', 'selectedCategory', 'photos'));
    }

    public function photo($categorySlug, $photoId)
    {
        $category = GalleryCategory::where('slug', $categorySlug)
            ->where('is_active', true)
            ->firstOrFail();

        $photo = GalleryPhoto::where('id', $photoId)
            ->where('category_id', $category->id)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related photos from the same category
        $relatedPhotos = GalleryPhoto::where('category_id', $category->id)
            ->where('id', '!=', $photo->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        return view('frontend.gallery.photo', compact('photo', 'category', 'relatedPhotos'));
    }
}
