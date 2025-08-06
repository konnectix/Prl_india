<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\EsgCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EsgCategoryController extends Controller
{
    public function index()
    {
        $categories = EsgCategory::withCount('articles')
            ->orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.esg.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.esg.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:esg_categories,name',
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');
        
        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('esg-banners', 'public');
            $data['banner_image'] = $bannerPath;
        }
        
        // Set default sort order if not provided
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = EsgCategory::max('sort_order') + 1;
        }

        EsgCategory::create($data);

        return redirect()->route('admin.esg.categories.index')
            ->with('success', 'ESG category created successfully.');
    }

    public function show(EsgCategory $category)
    {
        $category->load(['articles' => function($query) {
            $query->active()->published()->orderBy('published_at', 'desc')->take(10);
        }]);

        return view('admin.esg.categories.show', compact('category'));
    }

    public function edit(EsgCategory $category)
    {
        return view('admin.esg.categories.edit', compact('category'));
    }

    public function update(Request $request, EsgCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:esg_categories,name,' . $category->id,
            'description' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'color' => 'nullable|string|max:7',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active');

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            // Delete old banner image
            if ($category->banner_image) {
                Storage::disk('public')->delete($category->banner_image);
            }
            $bannerPath = $request->file('banner_image')->store('esg-banners', 'public');
            $data['banner_image'] = $bannerPath;
        }

        $category->update($data);

        return redirect()->route('admin.esg.categories.index')
            ->with('success', 'ESG category updated successfully.');
    }

    public function destroy(EsgCategory $category)
    {
        // Check if category has articles
        if ($category->articles()->count() > 0) {
            return redirect()->route('admin.esg.categories.index')
                ->with('error', 'Cannot delete category that contains articles. Please move or delete articles first.');
        }

        // Delete banner image
        if ($category->banner_image) {
            Storage::disk('public')->delete($category->banner_image);
        }

        $category->delete();

        return redirect()->route('admin.esg.categories.index')
            ->with('success', 'ESG category deleted successfully.');
    }
}
