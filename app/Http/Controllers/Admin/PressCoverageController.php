<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PressCoverage;
use App\Models\PressCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PressCoverageController extends Controller
{
    public function index(Request $request)
    {
        $categories = PressCategory::where('is_active', true)->orderBy('sort_order')->get();
        
        $query = PressCoverage::with('category');
        
        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('is_featured') && $request->is_featured != '') {
            $query->where('is_featured', $request->is_featured);
        }
        
        $articles = $query->orderBy('published_date', 'desc')->orderBy('sort_order')->paginate(12);
        
        return view('admin.press.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = PressCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.press.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            // Debug logging
            Log::info('Press Article Store Method Called');
            Log::info('Request Data: ', $request->all());
            
            $validatedData = $request->validate([
                'category_id' => 'required|exists:press_categories,id',
                'title' => 'required|string|max:255',
                'excerpt' => 'nullable|string|max:500',
                'content' => 'nullable|string',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'external_url' => 'nullable|url',
                'source' => 'nullable|string|max:255',
                'published_date' => 'nullable|date',
                'author' => 'nullable|string|max:255',
                'tags' => 'nullable|string',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            Log::info('Validation passed. Validated data: ', $validatedData);

            $data = $validatedData;
            $data['is_featured'] = $request->has('is_featured');
            $data['is_active'] = $request->has('is_active');
            
            // Handle published date
            if ($request->published_date) {
                $data['published_date'] = Carbon::parse($request->published_date);
            }

            // Handle tags
            if ($request->tags) {
                $tags = array_map('trim', explode(',', $request->tags));
                $data['tags'] = array_filter($tags);
            }

            // Handle image upload
            if ($request->hasFile('featured_image')) {
                $imagePath = $request->file('featured_image')->store('press', 'public');
                $data['featured_image'] = $imagePath;
            }

            Log::info('Processed Data: ', $data);

            $article = PressCoverage::create($data);
            
            Log::info('Article Created: ', ['id' => $article->id, 'title' => $article->title]);

            return redirect()->route('admin.press.articles.index')
                ->with('success', 'Press article created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Press Article Validation Error: ', $e->errors());
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Press Article Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the article: ' . $e->getMessage());
        }
    }

    public function show(PressCoverage $article)
    {
        $article->load('category');
        
        $relatedArticles = PressCoverage::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('is_active', true)
            ->latest()
            ->limit(5)
            ->get();
            
        return view('admin.press.articles.show', compact('article', 'relatedArticles'));
    }

    public function edit(PressCoverage $article)
    {
        $categories = PressCategory::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.press.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, PressCoverage $article)
    {
        $request->validate([
            'category_id' => 'required|exists:press_categories,id',
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'external_url' => 'nullable|url',
            'source' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'author' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'category_id', 'title', 'excerpt', 'content', 'external_url', 
            'source', 'published_date', 'author', 'tags', 'sort_order'
        ]);
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        
        // Handle published date
        if ($request->published_date) {
            $data['published_date'] = Carbon::parse($request->published_date);
        }

        // Handle tags
        if ($request->tags) {
            $tags = array_map('trim', explode(',', $request->tags));
            $data['tags'] = array_filter($tags);
        } else {
            $data['tags'] = null;
        }

        // Handle image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('press', 'public');
            $data['featured_image'] = $imagePath;
        }

        $article->update($data);

        return redirect()->route('admin.press.articles.index')
            ->with('success', 'Press article updated successfully.');
    }

    public function destroy(PressCoverage $article)
    {
        // Delete image file if exists
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }
        
        $article->delete();
        
        return redirect()->route('admin.press.articles.index')
            ->with('success', 'Press article deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'article_ids' => 'required|array',
            'article_ids.*' => 'exists:press_coverages,id'
        ]);

        $articles = PressCoverage::whereIn('id', $request->article_ids)->get();
        
        foreach ($articles as $article) {
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }
            $article->delete();
        }

        return redirect()->route('admin.press.articles.index')
            ->with('success', count($request->article_ids) . ' articles deleted successfully.');
    }

    public function toggleFeatured(PressCoverage $article)
    {
        $article->update(['is_featured' => !$article->is_featured]);
        
        $status = $article->is_featured ? 'featured' : 'unfeatured';
        return redirect()->back()->with('success', "Article has been {$status} successfully.");
    }

    public function toggleStatus(PressCoverage $article)
    {
        $article->update(['is_active' => !$article->is_active]);
        
        $status = $article->is_active ? 'activated' : 'deactivated';
        return redirect()->back()->with('success', "Article has been {$status} successfully.");
    }
}
