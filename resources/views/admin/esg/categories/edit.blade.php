@extends('admin.layouts.app')

@section('title', 'Edit ESG Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit ESG Category</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.esg.categories.index') }}">ESG Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Category: {{ $category->name }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.esg.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                           value="{{ old('slug', $category->slug) }}" placeholder="Auto-generated if empty">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Leave empty to auto-generate from name</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" placeholder="Enter category description">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="color" class="form-label">Category Color</label>
                                    <div class="input-group">
                                        <input type="color" name="color" id="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                               value="{{ old('color', $category->color ?: '#007bff') }}" title="Choose category color">
                                        <input type="text" class="form-control" id="colorHex" value="{{ old('color', $category->color ?: '#007bff') }}" readonly>
                                    </div>
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">This color will be used for category styling</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sort_order" class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                                           value="{{ old('sort_order', $category->sort_order) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Lower numbers appear first</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            
                            @if($category->banner_image)
                                <div class="current-image mb-2">
                                    <p class="mb-1"><strong>Current Banner:</strong></p>
                                    <img src="{{ $category->full_banner_image_url }}" alt="{{ $category->name }}" 
                                         class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input type="checkbox" name="remove_banner" id="remove_banner" class="form-check-input" value="1">
                                        <label for="remove_banner" class="form-check-label">Remove current banner</label>
                                    </div>
                                </div>
                            @endif
                            
                            <input type="file" name="banner_image" id="banner_image" class="form-control @error('banner_image') is-invalid @enderror" 
                                   accept="image/*">
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Upload a new banner image to replace the current one (JPEG, PNG, JPG, GIF - Max: 2MB)</div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <p class="mb-1"><strong>New Banner Preview:</strong></p>
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                                       {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-text">Inactive categories won't be displayed on the frontend</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.esg.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Categories
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Category Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="border rounded p-2">
                                <h4 class="text-primary mb-1">{{ $category->getActiveArticlesCount() }}</h4>
                                <p class="text-muted mb-0">Active Articles</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-2">
                                <h4 class="text-info mb-1">{{ $category->articles()->count() }}</h4>
                                <p class="text-muted mb-0">Total Articles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.esg.categories.show', $category) }}" class="btn btn-outline-info">
                            <i class="fas fa-eye"></i> View Category
                        </a>
                        <a href="{{ route('admin.esg.articles.index') }}?category={{ $category->id }}" class="btn btn-outline-primary">
                            <i class="fas fa-newspaper"></i> View Articles
                        </a>
                        <a href="{{ route('admin.esg.articles.create') }}?category={{ $category->id }}" class="btn btn-outline-success">
                            <i class="fas fa-plus"></i> Add Article
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Auto-generate slug from name (only if slug is empty)
    $('#name').on('input', function() {
        let currentSlug = $('#slug').val().trim();
        if (currentSlug === '' || currentSlug === '{{ $category->slug }}') {
            let name = $(this).val();
            let slug = name.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/-+/g, '-') // Replace multiple hyphens with single
                .trim('-'); // Remove leading/trailing hyphens
            
            $('#slug').val(slug);
        }
    });

    // Color picker sync
    $('#color').on('input', function() {
        $('#colorHex').val($(this).val());
    });

    // Image preview
    $('#banner_image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
                $('#imagePreview').show();
            };
            reader.readAsDataURL(file);
        } else {
            $('#imagePreview').hide();
        }
    });

    // Remove banner checkbox
    $('#remove_banner').on('change', function() {
        if ($(this).is(':checked')) {
            $('.current-image img').css('opacity', '0.5');
        } else {
            $('.current-image img').css('opacity', '1');
        }
    });
});
</script>
@endsection
