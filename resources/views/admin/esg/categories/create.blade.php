@extends('admin.layouts.app')

@section('title', 'Create ESG Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create ESG Category</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.esg.categories.index') }}">ESG Categories</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Category Details</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.esg.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                           value="{{ old('slug') }}" placeholder="Auto-generated if empty">
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
                                      rows="4" placeholder="Enter category description">{{ old('description') }}</textarea>
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
                                               value="{{ old('color', '#007bff') }}" title="Choose category color">
                                        <input type="text" class="form-control" id="colorHex" value="{{ old('color', '#007bff') }}" readonly>
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
                                           value="{{ old('sort_order', 0) }}" min="0">
                                    @error('sort_order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Lower numbers appear first</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="banner_image" class="form-label">Banner Image</label>
                            <input type="file" name="banner_image" id="banner_image" class="form-control @error('banner_image') is-invalid @enderror" 
                                   accept="image/*">
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Upload a banner image for this category (JPEG, PNG, JPG, GIF - Max: 2MB)</div>
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">Active</label>
                            </div>
                            <div class="form-text">Inactive categories won't be displayed on the frontend</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.esg.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Categories
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Help & Guidelines</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> ESG Category Guidelines</h6>
                        <ul class="mb-0">
                            <li><strong>Name:</strong> Choose a clear, descriptive name</li>
                            <li><strong>Color:</strong> Select a unique color for visual identification</li>
                            <li><strong>Sort Order:</strong> Lower numbers appear first in listings</li>
                            <li><strong>Banner:</strong> Use high-quality images (recommended: 1200x400px)</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle"></i> Common ESG Categories</h6>
                        <ul class="mb-0">
                            <li>Environmental</li>
                            <li>Social</li>
                            <li>Governance</li>
                            <li>Sustainability</li>
                            <li>Corporate Responsibility</li>
                        </ul>
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
    // Auto-generate slug from name
    $('#name').on('input', function() {
        let name = $(this).val();
        let slug = name.toLowerCase()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single
            .trim('-'); // Remove leading/trailing hyphens
        
        $('#slug').val(slug);
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
});
</script>
@endsection
