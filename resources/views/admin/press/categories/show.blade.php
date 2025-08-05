@extends('admin.layouts.app')

@section('title', $category->name . ' - Press Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $category->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.press.categories.edit', $category) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Category
        </a>
        <a href="{{ route('admin.press.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Categories
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Category Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Slug:</strong></td>
                        <td><code>{{ $category->slug }}</code></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Sort Order:</strong></td>
                        <td>{{ $category->sort_order }}</td>
                    </tr>
                    <tr>
                        <td><strong>Articles:</strong></td>
                        <td><span class="badge bg-info">{{ $category->pressArticles->count() }}</span></td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
                
                @if($category->description)
                    <div class="mt-3">
                        <strong>Description:</strong>
                        <p class="mt-2">{{ $category->description }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Press Articles ({{ $category->pressArticles->count() }})</h6>
                <a href="{{ route('admin.press.articles.create', ['category_id' => $category->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-2"></i>Add Article
                </a>
            </div>
            <div class="card-body">
                @if($category->pressArticles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Published</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category->pressArticles as $article)
                                    <tr>
                                        <td>
                                            <strong>{{ Str::limit($article->title, 40) }}</strong>
                                            @if($article->is_featured)
                                                <span class="badge bg-warning ms-1">Featured</span>
                                            @endif
                                        </td>
                                        <td>{{ $article->author ?? 'N/A' }}</td>
                                        <td>
                                            @if($article->published_date)
                                                {{ $article->published_date->format('M d, Y') }}
                                            @else
                                                <span class="text-muted">Not set</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($article->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.press.articles.show', $article) }}" 
                                                   class="btn btn-outline-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.press.articles.edit', $article) }}" 
                                                   class="btn btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.press.articles.destroy', $article) }}" 
                                                      class="d-inline" onsubmit="return confirm('Delete this article?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Articles Yet</h5>
                        <p class="text-muted">Start adding press articles to this category.</p>
                        <a href="{{ route('admin.press.articles.create', ['category_id' => $category->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First Article
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
