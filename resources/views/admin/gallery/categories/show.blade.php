@extends('admin.layouts.app')

@section('title', $category->name . ' - Gallery Category')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $category->name }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.gallery.categories.edit', $category) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Category
        </a>
        <a href="{{ route('admin.gallery.categories.index') }}" class="btn btn-secondary">
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
                        <td><strong>Photos:</strong></td>
                        <td><span class="badge bg-info">{{ $category->photos->count() }}</span></td>
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
                <h6 class="mb-0">Category Photos ({{ $category->photos->count() }})</h6>
                <a href="{{ route('admin.gallery.photos.create', ['category_id' => $category->id]) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-2"></i>Add Photo
                </a>
            </div>
            <div class="card-body">
                @if($category->photos->count() > 0)
                    <div class="row">
                        @foreach($category->photos as $photo)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="position-relative">
                                        @if($photo->image_path)
                                            <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                                 class="card-img-top" style="height: 150px; object-fit: cover;" 
                                                 alt="{{ $photo->alt_text ?? $photo->title }}">
                                        @elseif($photo->image_url)
                                            <img src="{{ $photo->image_url }}" 
                                                 class="card-img-top" style="height: 150px; object-fit: cover;" 
                                                 alt="{{ $photo->alt_text ?? $photo->title }}">
                                        @else
                                            <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                            </div>
                                        @endif
                                        
                                        @if(!$photo->is_active)
                                            <span class="position-absolute top-0 start-0 badge bg-warning m-2">Inactive</span>
                                        @endif
                                    </div>
                                    <div class="card-body p-2">
                                        <h6 class="card-title small mb-1">{{ Str::limit($photo->title, 30) }}</h6>
                                        <div class="d-flex justify-content-between">
                                            <small class="text-muted">Order: {{ $photo->sort_order }}</small>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.gallery.photos.edit', $photo) }}" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.gallery.photos.destroy', $photo) }}" 
                                                      class="d-inline" onsubmit="return confirm('Delete this photo?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-images fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Photos Yet</h5>
                        <p class="text-muted">Start adding photos to this category.</p>
                        <a href="{{ route('admin.gallery.photos.create', ['category_id' => $category->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First Photo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
