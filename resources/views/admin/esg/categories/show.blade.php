@extends('admin.layouts.app')

@section('title', 'View ESG Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">ESG Category Details</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.esg.categories.index') }}">ESG Categories</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">{{ $category->name }}</h4>
                        <div>
                            @if($category->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($category->banner_image)
                        <div class="mb-4">
                            <img src="{{ $category->full_banner_image_url }}" alt="{{ $category->name }}" 
                                 class="img-fluid rounded" style="max-height: 300px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Category Information</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="120"><strong>Name:</strong></td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Slug:</strong></td>
                                    <td><code>{{ $category->slug }}</code></td>
                                </tr>
                                <tr>
                                    <td><strong>Sort Order:</strong></td>
                                    <td>{{ $category->sort_order }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>
                                        @if($category->color)
                                            <div class="d-flex align-items-center">
                                                <div style="width: 20px; height: 20px; background-color: {{ $category->color }}; border-radius: 3px; border: 1px solid #ddd; margin-right: 8px;"></div>
                                                <code>{{ $category->color }}</code>
                                            </div>
                                        @else
                                            <span class="text-muted">Not set</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Statistics</h6>
                            <table class="table table-sm">
                                <tr>
                                    <td width="150"><strong>Total Articles:</strong></td>
                                    <td><span class="badge bg-info">{{ $category->articles()->count() }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Active Articles:</strong></td>
                                    <td><span class="badge bg-success">{{ $category->getActiveArticlesCount() }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Featured Articles:</strong></td>
                                    <td><span class="badge bg-warning">{{ $category->articles()->where('is_featured', true)->count() }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $category->created_at->format('M d, Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated:</strong></td>
                                    <td>{{ $category->updated_at->format('M d, Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($category->description)
                        <div class="mb-4">
                            <h6 class="text-muted">Description</h6>
                            <div class="border rounded p-3 bg-light">
                                {{ $category->description }}
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.esg.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Categories
                        </a>
                        <div>
                            <a href="{{ route('frontend.esg-category', $category->slug) }}" class="btn btn-outline-info" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View Frontend
                            </a>
                            <a href="{{ route('admin.esg.categories.edit', $category) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Category
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.esg.categories.edit', $category) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Category
                        </a>
                        <a href="{{ route('admin.esg.articles.create') }}?category={{ $category->id }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add New Article
                        </a>
                        <a href="{{ route('admin.esg.articles.index') }}?category={{ $category->id }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> View All Articles
                        </a>
                        <a href="{{ route('frontend.esg-category', $category->slug) }}" class="btn btn-info" target="_blank">
                            <i class="fas fa-external-link-alt"></i> View on Frontend
                        </a>
                    </div>
                </div>
            </div>

            @if($category->articles()->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Articles</h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($category->articles()->orderBy('created_at', 'desc')->take(5)->get() as $article)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('admin.esg.articles.show', $article) }}" class="text-decoration-none">
                                                    {{ Str::limit($article->title, 40) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ $article->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <div>
                                            @if($article->is_featured)
                                                <span class="badge bg-warning text-dark">Featured</span>
                                            @endif
                                            @if($article->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
