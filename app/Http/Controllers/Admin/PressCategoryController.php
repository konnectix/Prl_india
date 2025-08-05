<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PressCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PressCategoryController extends Controller
{
    public function index()
    {
        $categories = PressCategory::withCount('pressArticles')->orderBy('sort_order')->paginate(10);
        return view('admin.press.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.press.categories.create');
    }

    public function store(Request $request)
    {
        try {
            // Debug logging
            Log::info('Press Category Store Method Called');
            Log::info('Request Data: ', $request->all());
            Log::info('Request Headers: ', $request->headers->all());
            
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'sort_order' => 'nullable|integer|min:0',
            ]);

            Log::info('Validation passed. Validated data: ', $validatedData);

            $data = $validatedData;
            $data['slug'] = Str::slug($request->name);
            $data['is_active'] = $request->has('is_active');

            Log::info('Processed Data: ', $data);

            $category = PressCategory::create($data);
            
            Log::info('Category Created: ', ['id' => $category->id, 'name' => $category->name]);

            return redirect()->route('admin.press.categories.index')
                ->with('success', 'Press category created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Press Category Validation Error: ', $e->errors());
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            Log::error('Press Category Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while creating the category: ' . $e->getMessage());
        }
    }

    public function show(PressCategory $category)
    {
        $category->load(['pressArticles' => function($query) {
            $query->orderBy('sort_order');
        }]);
        return view('admin.press.categories.show', compact('category'));
    }

    public function edit(PressCategory $category)
    {
        return view('admin.press.categories.edit', compact('category'));
    }

    public function update(Request $request, PressCategory $category)
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

        return redirect()->route('admin.press.categories.index')
            ->with('success', 'Press category updated successfully.');
    }

    public function destroy(PressCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.press.categories.index')
            ->with('success', 'Press category deleted successfully.');
    }
}
