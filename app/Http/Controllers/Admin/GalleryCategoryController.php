<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
        try {
            // Debug logging
            Log::info('Gallery Category Store Method Called');
            Log::info('Request Data: ', $request->all());
            
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            $data = $request->only(['name', 'description', 'sort_order']);
            $data['slug'] = Str::slug($request->name);
            $data['is_active'] = $request->has('is_active');

            Log::info('Processed Data: ', $data);

            $category = GalleryCategory::create($data);
            
            Log::info('Category Created: ', ['id' => $category->id, 'name' => $category->name]);

            return redirect()->route('admin.gallery.categories.index')
                ->with('success', 'Gallery category created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Gallery Category Validation Error: ', $e->errors());
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Gallery Category Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the category: ' . $e->getMessage());
        }
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
        ]);

        $data = $request->only(['name', 'description', 'sort_order']);
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
