@extends('admin.layouts.app')

@section('title', 'Press Article Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">{{ $article->title }}</h1>
        <p class="text-muted mb-0">{{ $article->category->name }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.press.articles.edit', $article) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Article
        </a>
        <a href="{{ route('admin.press.articles.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Articles
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <!-- Article Content -->
        <div class="card">
            <div class="card-body">
                @if($article->featured_image)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('storage/' . $article->featured_image) }}" 
                             class="img-fluid rounded" style="max-height: 400px;">
                    </div>
                @endif

                @if($article->excerpt)
                    <div class="alert alert-info">
                        <h6 class="mb-2">Article Summary:</h6>
                        <p class="mb-0">{{ $article->excerpt }}</p>
                    </div>
                @endif

                @if($article->content)
                    <div class="article-content">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                @else
                    <p class="text-muted fst-italic">No content available for this article.</p>
                @endif

                @if($article->external_url)
                    <div class="mt-4 p-3 bg-light rounded">
                        <h6>External Link:</h6>
                        <a href="{{ $article->external_url }}" target="_blank" class="btn btn-outline-primary">
                            <i class="fas fa-external-link-alt me-2"></i>Read Full Article
                        </a>
                    </div>
                @endif

                @if($article->tags && count($article->tags) > 0)
                    <div class="mt-4">
                        <h6>Tags:</h6>
                        @foreach($article->tags as $tag)
                            <span class="badge bg-secondary me-1">{{ $tag }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Article Information -->
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Article Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Category:</strong><br>
                    <span class="badge bg-primary">{{ $article->category->name }}</span>
                </div>

                <div class="mb-3">
                    <strong>Status:</strong><br>
                    @if($article->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Featured:</strong><br>
                    @if($article->is_featured)
                        <span class="badge bg-warning text-dark">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </div>

                @if($article->source)
                    <div class="mb-3">
                        <strong>Source:</strong><br>
                        {{ $article->source }}
                    </div>
                @endif

                @if($article->author)
                    <div class="mb-3">
                        <strong>Author:</strong><br>
                        {{ $article->author }}
                    </div>
                @endif

                @if($article->published_date)
                    <div class="mb-3">
                        <strong>Published Date:</strong><br>
                        {{ $article->published_date->format('M d, Y') }}
                    </div>
                @endif

                <div class="mb-3">
                    <strong>Sort Order:</strong><br>
                    {{ $article->sort_order }}
                </div>

                <div class="mb-3">
                    <strong>Created:</strong><br>
                    {{ $article->created_at->format('M d, Y g:i A') }}
                </div>

                <div class="mb-0">
                    <strong>Last Updated:</strong><br>
                    {{ $article->updated_at->format('M d, Y g:i A') }}
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.press.articles.edit', $article) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Article
                    </a>
                    
                    @if($article->is_active)
                        <form method="POST" action="{{ route('admin.press.articles.toggle-status', $article) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning w-100" 
                                    onclick="return confirm('Are you sure you want to deactivate this article?')">
                                <i class="fas fa-eye-slash me-2"></i>Deactivate
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.press.articles.toggle-status', $article) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-eye me-2"></i>Activate
                            </button>
                        </form>
                    @endif

                    @if($article->is_featured)
                        <form method="POST" action="{{ route('admin.press.articles.toggle-featured', $article) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-warning w-100">
                                <i class="fas fa-star-half-alt me-2"></i>Remove Featured
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.press.articles.toggle-featured', $article) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="fas fa-star me-2"></i>Make Featured
                            </button>
                        </form>
                    @endif

                    <hr>

                    <form method="POST" action="{{ route('admin.press.articles.destroy', $article) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this article? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Article
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Related Articles</h6>
                </div>
                <div class="card-body">
                    @foreach($relatedArticles as $related)
                        <div class="d-flex align-items-center mb-2">
                            @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                     class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            @endif
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.press.articles.show', $related) }}" 
                                   class="text-decoration-none">
                                    <small class="d-block">{{ Str::limit($related->title, 50) }}</small>
                                </a>
                                <small class="text-muted">{{ $related->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
    .article-content {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #333;
    }
    
    .article-content p {
        margin-bottom: 1rem;
    }
</style>
@endsection
