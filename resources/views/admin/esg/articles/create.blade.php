@extends('admin.layouts.app')

@section('title', 'Create ESG Article')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Create ESG Article</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.esg.articles.index') }}">ESG Articles</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.esg.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Article Content</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Article Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" required placeholder="Enter article title">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                                   value="{{ old('slug') }}" placeholder="Auto-generated if empty">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to auto-generate from title</div>
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" 
                                      rows="3" placeholder="Brief description of the article">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Optional summary that appears in listings</div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" 
                                      rows="15" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">SEO Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror" 
                                      rows="2" maxlength="160" placeholder="SEO meta description">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Recommended: 150-160 characters</div>
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                   value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                            @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Separate keywords with commas</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Article Settings -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Article Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', request('category')) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" name="published_at" id="published_at" 
                                   class="form-control @error('published_at') is-invalid @enderror" 
                                   value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Leave empty to save as draft</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">Active</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="is_featured" id="is_featured" class="form-check-input" value="1" 
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="form-check-label">Featured Article</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Featured Image</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="file" name="featured_image" id="featured_image" 
                                   class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">JPEG, PNG, JPG, GIF - Max: 2MB</div>
                        </div>

                        <!-- Image Preview -->
                        <div id="imagePreview" style="display: none;">
                            <img id="preview" src="" alt="Preview" class="img-fluid rounded">
                        </div>
                    </div>
                </div>

                <!-- Gallery Images -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Gallery Images</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <input type="file" name="images[]" id="gallery_images" 
                                   class="form-control @error('images.*') is-invalid @enderror" 
                                   accept="image/*" multiple>
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Select multiple images for gallery</div>
                        </div>

                        <!-- Gallery Preview -->
                        <div id="galleryPreview" class="row"></div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Article
                            </button>
                            <a href="{{ route('admin.esg.articles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Quill editor
    var quill = new Quill('#content', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                [{ 'direction': 'rtl' }],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'align': [] }],
                ['link', 'image', 'video'],
                ['clean']
            ]
        }
    });

    // Auto-generate slug from title
    $('#title').on('input', function() {
        let title = $(this).val();
        let slug = title.toLowerCase()
            .replace(/[^\w\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single
            .trim('-'); // Remove leading/trailing hyphens
        
        $('#slug').val(slug);
    });

    // Featured image preview
    $('#featured_image').on('change', function() {
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

    // Gallery images preview
    $('#gallery_images').on('change', function() {
        const files = this.files;
        $('#galleryPreview').empty();
        
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#galleryPreview').append(`
                        <div class="col-6 mb-2">
                            <img src="${e.target.result}" class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    // Form submission - get Quill content
    $('form').on('submit', function() {
        const content = quill.root.innerHTML;
        $('#content').val(content);
    });
});
</script>
@endsection
