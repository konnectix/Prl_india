@extends('admin.layouts.app')

@section('title', 'Gallery Photos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Gallery Photos</h1>
    <a href="{{ route('admin.gallery.photos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Photo
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Filters -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.gallery.photos.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="category_id" class="form-label">Filter by Category</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="search" class="form-label">Search Photos</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Search by title...">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
                <a href="{{ route('admin.gallery.photos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Clear
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">All Photos ({{ $photos->total() }})</h6>
        <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
            <i class="fas fa-trash me-2"></i>Delete Selected
        </button>
    </div>
    <div class="card-body">
        @if($photos->count() > 0)
            <form id="bulkDeleteForm" method="POST" action="{{ route('admin.gallery.photos.bulk-delete') }}">
                @csrf
                <div class="row">
                    @foreach($photos as $photo)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <div class="position-relative">
                                    <div class="form-check position-absolute top-0 start-0 m-2">
                                        <input class="form-check-input photo-checkbox" type="checkbox" 
                                               name="photo_ids[]" value="{{ $photo->id }}">
                                    </div>
                                    
                                    @if($photo->image_path)
                                        <img src="{{ asset('storage/' . $photo->image_path) }}" 
                                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                                             alt="{{ $photo->alt_text ?? $photo->title }}">
                                    @elseif($photo->image_url)
                                        <img src="{{ $photo->image_url }}" 
                                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                                             alt="{{ $photo->alt_text ?? $photo->title }}">
                                    @else
                                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                            <i class="fas fa-image fa-2x text-muted"></i>
                                        </div>
                                    @endif
                                    
                                    @if(!$photo->is_active)
                                        <span class="position-absolute top-0 end-0 badge bg-warning m-2">Inactive</span>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">{{ Str::limit($photo->title, 40) }}</h6>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            <i class="fas fa-folder me-1"></i>{{ $photo->category->name }}<br>
                                            <i class="fas fa-sort me-1"></i>Order: {{ $photo->sort_order }}
                                        </small>
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.gallery.photos.show', $photo) }}" 
                                               class="btn btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.gallery.photos.edit', $photo) }}" 
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.gallery.photos.destroy', $photo) }}" 
                                                  class="d-inline" onsubmit="return confirm('Delete this photo?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
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
            </form>
            
            {{ $photos->appends(request()->query())->links() }}
        @else
            <div class="text-center py-4">
                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No Photos Found</h5>
                <p class="text-muted">
                    @if(request()->has('category_id') || request()->has('search'))
                        Try adjusting your filters or 
                        <a href="{{ route('admin.gallery.photos.index') }}">clear all filters</a>.
                    @else
                        Start by adding your first photo.
                    @endif
                </p>
                <a href="{{ route('admin.gallery.photos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Photo
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.photo-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.photo-checkbox:checked');
            bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateBulkDeleteButton);
        });

        bulkDeleteBtn.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.photo-checkbox:checked');
            if (checkedBoxes.length > 0 && confirm(`Delete ${checkedBoxes.length} selected photos?`)) {
                bulkDeleteForm.submit();
            }
        });
    });
</script>
@endsection
