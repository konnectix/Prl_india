@extends('admin.layouts.app')

@section('title', 'Edit Press Article')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Press Article</h1>
    <a href="{{ route('admin.press.articles.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Articles
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Article Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.press.articles.update', $article) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" 
                                id="category_id" name="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Article Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title', $article->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                  id="excerpt" name="excerpt" rows="3" maxlength="500">{{ old('excerpt', $article->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Brief summary of the article (max 500 characters)</div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="8">{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Current Image Display -->
                    @if($article->featured_image)
                        <div class="mb-3">
                            <label class="form-label">Current Featured Image</label>
                            <div class="current-image mb-3">
                                <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                     class="img-thumbnail" style="max-height: 150px;">
                                <p class="text-muted mt-2">Current image: {{ basename($article->featured_image) }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="featured_image" class="form-label">
                            @if($article->featured_image)
                                Update Featured Image
                            @else
                                Featured Image
                            @endif
                        </label>
                        <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                               id="featured_image" name="featured_image" accept="image/*">
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</div>
                    </div>

                    <div class="mb-3">
                        <label for="external_url" class="form-label">External URL</label>
                        <input type="url" class="form-control @error('external_url') is-invalid @enderror" 
                               id="external_url" name="external_url" value="{{ old('external_url', $article->external_url) }}"
                               placeholder="https://example.com/article">
                        @error('external_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Link to original article if published elsewhere</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="source" class="form-label">Source</label>
                                <input type="text" class="form-control @error('source') is-invalid @enderror" 
                                       id="source" name="source" value="{{ old('source', $article->source) }}"
                                       placeholder="e.g., Economic Times, Business Standard">
                                @error('source')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" class="form-control @error('author') is-invalid @enderror" 
                                       id="author" name="author" value="{{ old('author', $article->author) }}"
                                       placeholder="Author name">
                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="published_date" class="form-label">Published Date</label>
                                <input type="date" class="form-control @error('published_date') is-invalid @enderror" 
                                       id="published_date" name="published_date" 
                                       value="{{ old('published_date', $article->published_date ? $article->published_date->format('Y-m-d') : '') }}">
                                @error('published_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', $article->sort_order) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                               id="tags" name="tags" value="{{ old('tags', $article->tags_list) }}"
                               placeholder="logistics, transportation, manufacturing">
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Separate tags with commas</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" 
                                   {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Featured Article
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   {{ old('is_active', $article->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Article
                        </button>
                        <a href="{{ route('admin.press.articles.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Article Details</h6>
            </div>
            <div class="card-body">
                <p><strong>Category:</strong> {{ $article->category->name }}</p>
                <p><strong>Current Status:</strong> 
                    @if($article->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </p>
                <p><strong>Featured:</strong> 
                    @if($article->is_featured)
                        <span class="badge bg-warning">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </p>
                <p><strong>Created:</strong> {{ $article->created_at->format('M d, Y') }}</p>
                <p><strong>Updated:</strong> {{ $article->updated_at->format('M d, Y') }}</p>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">New Image Preview</h6>
            </div>
            <div class="card-body text-center">
                <div id="image_preview" style="display: none;">
                    <img id="preview_img" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <div id="no_preview" class="text-muted">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>No new image selected</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('featured_image');
        const previewDiv = document.getElementById('image_preview');
        const previewImg = document.getElementById('preview_img');
        const noPreview = document.getElementById('no_preview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewDiv.style.display = 'block';
                    noPreview.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.style.display = 'none';
                noPreview.style.display = 'block';
            }
        });
    });
</script>
@endsection
