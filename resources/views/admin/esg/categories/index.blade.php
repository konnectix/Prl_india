@extends('admin.layouts.app')

@section('title', 'ESG Categories')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">ESG Categories</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">ESG Categories</li>
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
                        <h4 class="card-title mb-0">ESG Categories Management</h4>
                        <a href="{{ route('admin.esg.categories.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Category
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

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="categoriesTable">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">ID</th>
                                    <th width="100">Banner</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th width="80">Color</th>
                                    <th width="80">Sort Order</th>
                                    <th width="100">Articles Count</th>
                                    <th width="80">Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            @if($category->banner_image)
                                                <img src="{{ $category->full_banner_image_url }}" alt="{{ $category->name }}" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $category->name }}</strong>
                                            <br><small class="text-muted">{{ $category->slug }}</small>
                                        </td>
                                        <td>{{ Str::limit($category->description, 80) }}</td>
                                        <td>
                                            @if($category->color)
                                                <div style="width: 30px; height: 30px; background-color: {{ $category->color }}; border-radius: 4px; border: 1px solid #ddd;"></div>
                                            @else
                                                <span class="text-muted">None</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->sort_order }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $category->articles_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            @if($category->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.esg.categories.show', $category) }}" class="btn btn-sm btn-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.esg.categories.edit', $category) }}" class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.esg.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
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
                                        <td colspan="9" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-folder-open fa-2x mb-2"></i>
                                                <p>No ESG categories found. <a href="{{ route('admin.esg.categories.create') }}">Create your first category</a></p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($categories->hasPages())
                        <div class="mt-3">
                            {{ $categories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#categoriesTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[5, 'asc']], // Sort by sort_order column
        columnDefs: [
            { orderable: false, targets: [1, 8] } // Disable sorting for banner and actions columns
        ]
    });
});
</script>
@endsection
