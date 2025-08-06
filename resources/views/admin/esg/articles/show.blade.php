@extends('admin.layouts.app')

@section('title', 'View ESG Article')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">ESG Article Details</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.esg.articles.index') }}">ESG Articles</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($article->title, 30) }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title mb-2">{{ $article->title }}</h4>
                            <div>
                                @if($article->is_featured)
                                    <span class="badge bg-warning text-dark">Featured</span>
                                @endif
                                @if($article->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                                @if($article->category)
                                    <span class="badge" style="background-color: {{ $article->category->color ?: '#6c757d' }};">
                                        {{ $article->category->name }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('admin.esg.articles.edit', $article) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('frontend.esg-article', [$article->category->slug, $article->slug]) }}" class="btn btn-info btn-sm" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($article->featured_image)
                        <div class="mb-4">
                            <img src="{{ $article->full_featured_image_url }}" alt="{{ $article->title }}" 
                                 class="img-fluid rounded" style="max-height: 400px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    @if($article->excerpt)
                        <div class="mb-4">
                            <h6 class="text-muted">Excerpt</h6>
                            <div class="border rounded p-3 bg-light">
                                {{ $article->excerpt }}
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h6 class="text-muted">Content</h6>
                        <div class="border rounded p-3">
                            {!! $article->content !!}
                        </div>
                    </div>

                    @if($article->images && count($article->images) > 0)
                        <div class="mb-4">
                            <h6 class="text-muted">Gallery Images</h6>
                            <div class="row">
                                @foreach($article->images as $image)
                                    <div class="col-md-3 col-sm-4 col-6 mb-3">
                                        <a href="{{ $article->getImageUrl($image) }}" target="_blank">
                                            <img src="{{ $article->getImageUrl($image) }}" alt="Gallery Image" 
                                                 class="img-fluid rounded" style="height: 150px; width: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($article->meta_description || $article->meta_keywords)
                        <div class="mb-4">
                            <h6 class="text-muted">SEO Information</h6>
                            <div class="border rounded p-3 bg-light">
                                @if($article->meta_description)
                                    <p class="mb-2"><strong>Meta Description:</strong> {{ $article->meta_description }}</p>
                                @endif
                                @if($article->meta_keywords)
                                    <p class="mb-0"><strong>Meta Keywords:</strong> {{ $article->meta_keywords }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.esg.articles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Articles
                        </a>
                        <div>
                            <a href="{{ route('frontend.esg-article', [$article->category->slug, $article->slug]) }}" class="btn btn-outline-info" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View on Frontend
                            </a>
                            <a href="{{ route('admin.esg.articles.edit', $article) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Article
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Article Info -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Article Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td width="120"><strong>Category:</strong></td>
                            <td>
                                @if($article->category)
                                    <a href="{{ route('admin.esg.categories.show', $article->category) }}" class="text-decoration-none">
                                        {{ $article->category->name }}
                                    </a>
                                @else
                                    <span class="text-muted">No Category</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Slug:</strong></td>
                            <td><code>{{ $article->slug }}</code></td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td>
                                @if($article->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Featured:</strong></td>
                            <td>
                                @if($article->is_featured)
                                    <span class="badge bg-warning text-dark">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Published:</strong></td>
                            <td>
                                @if($article->published_at)
                                    {{ $article->published_at->format('M d, Y H:i') }}
                                @else
                                    <span class="text-muted">Draft</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Views:</strong></td>
                            <td><span class="badge bg-info">{{ $article->views_count }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Created:</strong></td>
                            <td>{{ $article->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Updated:</strong></td>
                            <td>{{ $article->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.esg.articles.edit', $article) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Article
                        </a>
                        
                        <form action="{{ route('admin.esg.articles.toggle-featured', $article) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $article->is_featured ? 'outline-warning' : 'warning' }} w-100">
                                <i class="fas fa-star"></i> {{ $article->is_featured ? 'Remove Featured' : 'Make Featured' }}
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.esg.articles.toggle-status', $article) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $article->is_active ? 'outline-success' : 'success' }} w-100">
                                <i class="fas fa-{{ $article->is_active ? 'eye-slash' : 'eye' }}"></i> {{ $article->is_active ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                        
                        <a href="{{ route('frontend.esg-article', [$article->category->slug, $article->slug]) }}" class="btn btn-info" target="_blank">
                            <i class="fas fa-external-link-alt"></i> View on Frontend
                        </a>
                        
                        <form action="{{ route('admin.esg.articles.destroy', $article) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('Are you sure you want to delete this article?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fas fa-trash"></i> Delete Article
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @if($article->category && $article->category->articles()->where('id', '!=', $article->id)->exists())
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Other Articles in {{ $article->category->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($article->category->articles()->where('id', '!=', $article->id)->orderBy('created_at', 'desc')->take(5)->get() as $relatedArticle)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.esg.articles.show', $relatedArticle) }}" class="text-decoration-none">
                                                    {{ Str::limit($relatedArticle->title, 40) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ $relatedArticle->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <div>
                                            @if($relatedArticle->is_featured)
                                                <span class="badge bg-warning text-dark">Featured</span>
                                            @endif
                                            @if($relatedArticle->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ route('admin.esg.articles.index') }}?category={{ $article->category->id }}" class="btn btn-outline-primary btn-sm w-100">
                                View All Articles in {{ $article->category->name }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
