<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EsgArticle;
use App\Models\EsgCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EsgArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = EsgArticle::with('category')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.esg.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = EsgCategory::orderBy('sort_order')->get();
        return view('admin.esg.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:esg_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        // Ensure unique slug
        $originalSlug = $data['slug'];
        $count = 1;
        while (EsgArticle::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image');
            $filename = time() . '_featured_' . $featuredImage->getClientOriginalName();
            $data['featured_image'] = $featuredImage->storeAs('esg/articles', $filename, 'public');
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('esg/articles/gallery', $filename, 'public');
                $images[] = $path;
            }
            $data['images'] = json_encode($images);
        }

        // Set default values
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');
        $data['views_count'] = 0;

        // Convert published_at if provided
        if ($request->filled('published_at')) {
            $data['published_at'] = \Carbon\Carbon::parse($request->published_at);
        }

        EsgArticle::create($data);

        return redirect()->route('admin.esg.articles.index')
            ->with('success', 'ESG Article created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EsgArticle $article)
    {
        $article->load('category');
        return view('admin.esg.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EsgArticle $article)
    {
        $categories = EsgCategory::orderBy('sort_order')->get();
        return view('admin.esg.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EsgArticle $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:esg_categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_description' => 'nullable|string|max:160',
            'meta_keywords' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data = $request->all();
        
        // Generate slug if changed
        if ($data['title'] !== $article->title && empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
            
            // Ensure unique slug (excluding current article)
            $originalSlug = $data['slug'];
            $count = 1;
            while (EsgArticle::where('slug', $data['slug'])->where('id', '!=', $article->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            
            $featuredImage = $request->file('featured_image');
            $filename = time() . '_featured_' . $featuredImage->getClientOriginalName();
            $data['featured_image'] = $featuredImage->storeAs('esg/articles', $filename, 'public');
        }

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            // Delete old images if requested
            if ($request->has('delete_old_images') && $article->images) {
                foreach (json_decode($article->images, true) as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $existingImages = [];
            if (!$request->has('delete_old_images') && $article->images) {
                $existingImages = json_decode($article->images, true);
            }
            
            $newImages = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('esg/articles/gallery', $filename, 'public');
                $newImages[] = $path;
            }
            
            $allImages = array_merge($existingImages, $newImages);
            $data['images'] = json_encode($allImages);
        }

        // Set boolean values
        $data['is_active'] = $request->has('is_active');
        $data['is_featured'] = $request->has('is_featured');

        // Convert published_at if provided
        if ($request->filled('published_at')) {
            $data['published_at'] = \Carbon\Carbon::parse($request->published_at);
        } elseif (!$request->filled('published_at')) {
            $data['published_at'] = null;
        }

        $article->update($data);

        return redirect()->route('admin.esg.articles.index')
            ->with('success', 'ESG Article updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EsgArticle $article)
    {
        // Delete featured image
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }
        
        // Delete gallery images
        if ($article->images) {
            foreach (json_decode($article->images, true) as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $article->delete();

        return redirect()->route('admin.esg.articles.index')
            ->with('success', 'ESG Article deleted successfully.');
    }

    /**
     * Toggle featured status of the article.
     */
    public function toggleFeatured(EsgArticle $article)
    {
        $article->update(['is_featured' => !$article->is_featured]);
        
        $status = $article->is_featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Article {$status} successfully.");
    }

    /**
     * Toggle active status of the article.
     */
    public function toggleActive(EsgArticle $article)
    {
        $article->update(['is_active' => !$article->is_active]);
        
        $status = $article->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Article {$status} successfully.");
    }

    /**
     * Toggle status of the article (alias for toggleActive).
     */
    public function toggleStatus(EsgArticle $article)
    {
        return $this->toggleActive($article);
    }

    /**
     * Bulk delete articles.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'article_ids' => 'required|array',
            'article_ids.*' => 'exists:esg_articles,id'
        ]);

        $articles = EsgArticle::whereIn('id', $request->article_ids)->get();
        
        foreach ($articles as $article) {
            // Delete files
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            if ($article->images) {
                foreach (json_decode($article->images, true) as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $article->delete();
        }

        return redirect()->back()->with('success', 'Selected articles deleted successfully.');
    }
}
