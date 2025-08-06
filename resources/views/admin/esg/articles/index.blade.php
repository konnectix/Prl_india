@extends('admin.layouts.app')

@section('title', 'ESG Articles')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">ESG Articles</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">ESG Articles</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">ESG Articles Management</h4>
                        <a href="{{ route('admin.esg.articles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Article
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <select class="form-select" id="categoryFilter">
                                <option value="">All Categories</option>
                                @foreach(\App\Models\EsgCategory::orderBy('name')->get() as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="featuredFilter">
                                <option value="">All Articles</option>
                                <option value="featured" {{ request('featured') == 'featured' ? 'selected' : '' }}>Featured Only</option>
                                <option value="regular" {{ request('featured') == 'regular' ? 'selected' : '' }}>Regular Only</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                                <i class="fas fa-times"></i> Clear
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="articlesTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th width="80">Image</th>
                                    <th>Title</th>
                                    <th width="120">Category</th>
                                    <th width="80">Views</th>
                                    <th width="100">Status</th>
                                    <th width="100">Published</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($articles as $article)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input article-checkbox" value="{{ $article->id }}">
                                        </td>
                                        <td>
                                            @if($article->featured_image)
                                                <img src="{{ $article->full_featured_image_url }}" alt="{{ $article->title }}" 
                                                     class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                            @else
                                                <div class="bg-light border rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 40px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-1">
                                                    <a href="{{ route('admin.esg.articles.show', $article) }}" class="text-decoration-none">
                                                        {{ Str::limit($article->title, 50) }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">{{ $article->slug }}</small>
                                                <div class="mt-1">
                                                    @if($article->is_featured)
                                                        <span class="badge bg-warning text-dark">Featured</span>
                                                    @endif
                                                    @if($article->excerpt)
                                                        <span class="badge bg-info">Has Excerpt</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($article->category)
                                                <span class="badge" style="background-color: {{ $article->category->color ?: '#6c757d' }};">
                                                    {{ $article->category->name }}
                                                </span>
                                            @else
                                                <span class="text-muted">No Category</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $article->views_count }}</span>
                                        </td>
                                        <td>
                                            @if($article->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($article->published_at)
                                                <small>{{ $article->published_at->format('M d, Y') }}</small>
                                            @else
                                                <span class="text-muted">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.esg.articles.show', $article) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.esg.articles.edit', $article) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-{{ $article->is_featured ? 'warning' : 'outline-warning' }}" 
                                                        onclick="toggleFeatured({{ $article->id }})" title="Toggle Featured">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                                <form action="{{ route('admin.esg.articles.destroy', $article) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Are you sure you want to delete this article?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-newspaper fa-2x mb-2"></i>
                                                <p>No ESG articles found. <a href="{{ route('admin.esg.articles.create') }}">Create your first article</a></p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($articles->hasPages())
                        <div class="mt-3">
                            {{ $articles->links() }}
                        </div>
                    @endif

                    <!-- Bulk Actions -->
                    <div class="mt-3" id="bulkActions" style="display: none;">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-danger btn-sm" onclick="bulkDelete()">
                                <i class="fas fa-trash"></i> Delete Selected
                            </button>
                            <button type="button" class="btn btn-success btn-sm" onclick="bulkActivate()">
                                <i class="fas fa-check"></i> Activate Selected
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="bulkDeactivate()">
                                <i class="fas fa-times"></i> Deactivate Selected
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Delete Form -->
<form id="bulkDeleteForm" action="{{ route('admin.esg.articles.bulk-delete') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="article_ids" id="bulkDeleteIds">
</form>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#articlesTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[2, 'asc']], // Sort by title column
        columnDefs: [
            { orderable: false, targets: [0, 1, 7] } // Disable sorting for checkbox, image, and actions columns
        ]
    });

    // Handle select all checkbox
    $('#selectAll').on('change', function() {
        $('.article-checkbox').prop('checked', $(this).prop('checked'));
        toggleBulkActions();
    });

    // Handle individual checkboxes
    $('.article-checkbox').on('change', function() {
        toggleBulkActions();
    });

    // Filter handlers
    $('#categoryFilter, #statusFilter, #featuredFilter').on('change', function() {
        applyFilters();
    });
});

function toggleBulkActions() {
    const checkedBoxes = $('.article-checkbox:checked').length;
    if (checkedBoxes > 0) {
        $('#bulkActions').show();
    } else {
        $('#bulkActions').hide();
    }
}

function applyFilters() {
    const category = $('#categoryFilter').val();
    const status = $('#statusFilter').val();
    const featured = $('#featuredFilter').val();
    
    const params = new URLSearchParams();
    if (category) params.append('category', category);
    if (status) params.append('status', status);
    if (featured) params.append('featured', featured);
    
    window.location.href = window.location.pathname + (params.toString() ? '?' + params.toString() : '');
}

function clearFilters() {
    window.location.href = window.location.pathname;
}

function toggleFeatured(articleId) {
    // You would implement AJAX call here to toggle featured status
    console.log('Toggle featured for article:', articleId);
}

function bulkDelete() {
    const selectedIds = $('.article-checkbox:checked').map(function() {
        return $(this).val();
    }).get();
    
    if (selectedIds.length === 0) {
        alert('Please select articles to delete.');
        return;
    }
    
    if (confirm(`Are you sure you want to delete ${selectedIds.length} selected articles?`)) {
        $('#bulkDeleteIds').val(selectedIds.join(','));
        $('#bulkDeleteForm').submit();
    }
}

function bulkActivate() {
    // Implement bulk activate functionality
    console.log('Bulk activate');
}

function bulkDeactivate() {
    // Implement bulk deactivate functionality
    console.log('Bulk deactivate');
}
</script>
@endsection
