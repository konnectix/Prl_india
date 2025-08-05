@extends('admin.layouts.app')

@section('title', 'Press Articles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Press Articles</h1>
    <a href="{{ route('admin.press.articles.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Article
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
        <form method="GET" action="{{ route('admin.press.articles.index') }}" class="row g-3">
            <div class="col-md-3">
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
            <div class="col-md-3">
                <label for="is_featured" class="form-label">Featured Status</label>
                <select class="form-select" id="is_featured" name="is_featured">
                    <option value="">All Articles</option>
                    <option value="1" {{ request('is_featured') === '1' ? 'selected' : '' }}>Featured Only</option>
                    <option value="0" {{ request('is_featured') === '0' ? 'selected' : '' }}>Non-Featured</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="search" class="form-label">Search Articles</label>
                <input type="text" class="form-control" id="search" name="search" 
                       value="{{ request('search') }}" placeholder="Search by title...">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-search me-2"></i>Filter
                </button>
                <a href="{{ route('admin.press.articles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>Clear
                </a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">All Articles ({{ $articles->total() }})</h6>
        <button type="button" class="btn btn-danger btn-sm" id="bulkDeleteBtn" style="display: none;">
            <i class="fas fa-trash me-2"></i>Delete Selected
        </button>
    </div>
    <div class="card-body">
        @if($articles->count() > 0)
            <form id="bulkDeleteForm" method="POST" action="{{ route('admin.press.articles.bulk-delete') }}">
                @csrf
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30">
                                    <input type="checkbox" id="selectAll" class="form-check-input">
                                </th>
                                <th>Article</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Published</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="form-check-input article-checkbox" 
                                               name="article_ids[]" value="{{ $article->id }}">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($article->featured_image)
                                                <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                                     class="me-3 rounded" style="width: 50px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="me-3 bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 50px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <strong>{{ Str::limit($article->title, 50) }}</strong>
                                                @if($article->is_featured)
                                                    <span class="badge bg-warning ms-1">Featured</span>
                                                @endif
                                                @if($article->excerpt)
                                                    <br><small class="text-muted">{{ Str::limit($article->excerpt, 80) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $article->category->name }}</td>
                                    <td>{{ $article->author ?? 'N/A' }}</td>
                                    <td>
                                        @if($article->published_date)
                                            {{ $article->published_date->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">Not set</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($article->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.press.articles.show', $article) }}" 
                                               class="btn btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.press.articles.edit', $article) }}" 
                                               class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.press.articles.toggle-featured', $article) }}" 
                                                  class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-outline-warning" 
                                                        title="{{ $article->is_featured ? 'Remove from Featured' : 'Mark as Featured' }}">
                                                    <i class="fas fa-star{{ $article->is_featured ? '' : '-o' }}"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.press.articles.destroy', $article) }}" 
                                                  class="d-inline" onsubmit="return confirm('Delete this article?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            
            {{ $articles->appends(request()->query())->links() }}
        @else
            <div class="text-center py-4">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No Articles Found</h5>
                <p class="text-muted">
                    @if(request()->has('category_id') || request()->has('search') || request()->has('is_featured'))
                        Try adjusting your filters or 
                        <a href="{{ route('admin.press.articles.index') }}">clear all filters</a>.
                    @else
                        Start by adding your first press article.
                    @endif
                </p>
                <a href="{{ route('admin.press.articles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Article
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.article-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');

        // Select all functionality
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkDeleteButton();
        });

        // Individual checkbox functionality
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllState();
                updateBulkDeleteButton();
            });
        });

        function updateSelectAllState() {
            const checkedBoxes = document.querySelectorAll('.article-checkbox:checked');
            selectAll.checked = checkedBoxes.length === checkboxes.length;
            selectAll.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
        }

        function updateBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.article-checkbox:checked');
            bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'block' : 'none';
        }

        // Bulk delete functionality
        bulkDeleteBtn.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.article-checkbox:checked');
            if (checkedBoxes.length > 0 && confirm(`Delete ${checkedBoxes.length} selected articles?`)) {
                bulkDeleteForm.submit();
            }
        });
    });
</script>
@endsection
