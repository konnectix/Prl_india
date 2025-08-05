<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::withCount('photos')->orderBy('sort_order')->paginate(10);
        return view('admin.gallery.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.gallery.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        GalleryCategory::create($data);

        return redirect()->route('admin.gallery.categories.index')
            ->with('success', 'Gallery category created successfully.');
    }

    public function show(GalleryCategory $category)
    {
        $category->load(['photos' => function($query) {
            $query->orderBy('sort_order');
        }]);
        return view('admin.gallery.categories.show', compact('category'));
    }

    public function edit(GalleryCategory $category)
    {
        return view('admin.gallery.categories.edit', compact('category'));
    }

    public function update(Request $request, GalleryCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        $category->update($data);

        return redirect()->route('admin.gallery.categories.index')
            ->with('success', 'Gallery category updated successfully.');
    }

    public function destroy(GalleryCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.gallery.categories.index')
            ->with('success', 'Gallery category deleted successfully.');
    }
}
