@extends('admin.layouts.app')

@section('title', 'Video Category Details')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Video Category: {{ $category->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.video.categories.index') }}">Video Categories</a></li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Category Information</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.video.categories.edit', $category) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit Category
                                </a>
                            </div>
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
                                @if($category->description)
                                <tr>
                                    <td><strong>Description:</strong></td>
                                    <td>{{ $category->description }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Color:</strong></td>
                                    <td>
                                        @if($category->color)
                                            <div class="d-flex align-items-center">
                                                <div style="width: 25px; height: 25px; background-color: {{ $category->color }}; border: 1px solid #ddd; border-radius: 4px; margin-right: 8px;"></div>
                                                <code>{{ $category->color }}</code>
                                            </div>
                                        @else
                                            <span class="text-muted">No color set</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Sort Order:</strong></td>
                                    <td>{{ $category->sort_order }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Videos Count:</strong></td>
                                    <td><span class="badge badge-info">{{ $category->videos_count }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $category->created_at->format('M d, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated:</strong></td>
                                    <td>{{ $category->updated_at->format('M d, Y g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.video.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Categories
                            </a>
                            <a href="{{ route('admin.video.categories.edit', $category) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            @if($category->videos_count == 0)
                                <form action="{{ route('admin.video.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Videos in this Category</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.video.videos.create') }}?category={{ $category->id }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add Video to Category
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($category->videos->count() > 0)
                                <div class="row">
                                    @foreach($category->videos as $video)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="position-relative">
                                                    <img src="{{ $video->thumbnail_url }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $video->title }}">
                                                    <div class="position-absolute" style="top: 10px; right: 10px;">
                                                        @php
                                                            $typeColors = [
                                                                'youtube' => 'danger',
                                                                'vimeo' => 'info',
                                                                'upload' => 'success',
                                                                'external' => 'secondary'
                                                            ];
                                                        @endphp
                                                        <span class="badge badge-{{ $typeColors[$video->video_type] ?? 'secondary' }}">
                                                            {{ ucfirst($video->video_type) }}
                                                        </span>
                                                    </div>
                                                    @if($video->is_featured)
                                                        <div class="position-absolute" style="top: 10px; left: 10px;">
                                                            <span class="badge badge-warning">
                                                                <i class="fas fa-star"></i> Featured
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="card-body p-3">
                                                    <h6 class="card-title mb-2">{{ Str::limit($video->title, 40) }}</h6>
                                                    @if($video->description)
                                                        <p class="card-text text-muted small mb-2">{{ Str::limit($video->description, 60) }}</p>
                                                    @endif
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <small class="text-muted">
                                                            @if($video->duration)
                                                                <i class="fas fa-clock"></i> {{ gmdate('i:s', $video->duration) }}
                                                            @endif
                                                            <i class="fas fa-eye ml-2"></i> {{ number_format($video->view_count) }}
                                                        </small>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('admin.video.videos.show', $video) }}" class="btn btn-info btn-sm" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.video.videos.edit', $video) }}" class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer p-2">
                                                    <div class="d-flex justify-content-between">
                                                        <span class="badge badge-{{ $video->is_active ? 'success' : 'secondary' }}">
                                                            {{ $video->is_active ? 'Active' : 'Inactive' }}
                                                        </span>
                                                        <small class="text-muted">{{ $video->created_at->format('M d, Y') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center p-4">
                                    <i class="fas fa-video fa-3x text-muted mb-3"></i>
                                    <h5>No Videos in this Category</h5>
                                    <p class="text-muted">Add videos to this category to see them here.</p>
                                    <a href="{{ route('admin.video.videos.create') }}?category={{ $category->id }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add First Video
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
