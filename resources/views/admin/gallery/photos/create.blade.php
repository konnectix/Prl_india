@extends('admin.layouts.app')

@section('title', 'Add New Photo')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Add New Photo</h1>
    <a href="{{ route('admin.gallery.photos.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Photos
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Photo Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.gallery.photos.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', request('category_id')) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Photo Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload Options -->
                    <div class="mb-3">
                        <label class="form-label">Image Source</label>
                        <div class="btn-group w-100" role="group">
                            <input type="radio" class="btn-check" name="image_source" id="upload_option" value="upload" checked>
                            <label class="btn btn-outline-primary" for="upload_option">Upload Image</label>
                            
                            <input type="radio" class="btn-check" name="image_source" id="url_option" value="url">
                            <label class="btn btn-outline-primary" for="url_option">Image URL</label>
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div class="mb-3" id="upload_section">
                        <label for="image" class="form-label">Upload Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                               id="image" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</div>
                    </div>

                    <!-- URL Input -->
                    <div class="mb-3" id="url_section" style="display: none;">
                        <label for="image_url" class="form-label">Image URL</label>
                        <input type="url" class="form-control @error('image_url') is-invalid @enderror" 
                               id="image_url" name="image_url" value="{{ old('image_url') }}"
                               placeholder="https://example.com/image.jpg">
                        @error('image_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alt_text" class="form-label">Alt Text</label>
                        <input type="text" class="form-control @error('alt_text') is-invalid @enderror" 
                               id="alt_text" name="alt_text" value="{{ old('alt_text') }}"
                               placeholder="Descriptive text for accessibility">
                        @error('alt_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Lower numbers appear first</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Photo
                        </button>
                        <a href="{{ route('admin.gallery.photos.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-image text-info me-2"></i>Use high-quality images for better display</li>
                    <li class="mb-2"><i class="fas fa-compress text-warning me-2"></i>Optimize images for web (under 2MB)</li>
                    <li class="mb-2"><i class="fas fa-universal-access text-success me-2"></i>Add alt text for accessibility</li>
                    <li class="mb-2"><i class="fas fa-sort text-primary me-2"></i>Use sort order to control display sequence</li>
                    <li><i class="fas fa-eye-slash text-muted me-2"></i>Inactive photos won't appear on frontend</li>
                </ul>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Image Preview</h6>
            </div>
            <div class="card-body text-center">
                <div id="image_preview" style="display: none;">
                    <img id="preview_img" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <div id="no_preview" class="text-muted">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>No image selected</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadOption = document.getElementById('upload_option');
        const urlOption = document.getElementById('url_option');
        const uploadSection = document.getElementById('upload_section');
        const urlSection = document.getElementById('url_section');
        const imageInput = document.getElementById('image');
        const imageUrlInput = document.getElementById('image_url');
        const previewDiv = document.getElementById('image_preview');
        const previewImg = document.getElementById('preview_img');
        const noPreview = document.getElementById('no_preview');

        // Toggle between upload and URL options
        uploadOption.addEventListener('change', function() {
            if (this.checked) {
                uploadSection.style.display = 'block';
                urlSection.style.display = 'none';
                imageUrlInput.value = '';
            }
        });

        urlOption.addEventListener('change', function() {
            if (this.checked) {
                uploadSection.style.display = 'none';
                urlSection.style.display = 'block';
                imageInput.value = '';
                hidePreview();
            }
        });

        // Image upload preview
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    showPreview(e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                hidePreview();
            }
        });

        // Image URL preview
        imageUrlInput.addEventListener('input', function() {
            const url = this.value.trim();
            if (url) {
                showPreview(url);
            } else {
                hidePreview();
            }
        });

        function showPreview(src) {
            previewImg.src = src;
            previewDiv.style.display = 'block';
            noPreview.style.display = 'none';
        }

        function hidePreview() {
            previewDiv.style.display = 'none';
            noPreview.style.display = 'block';
        }
    });
</script>
@endsection
