@extends('admin.layouts.app')

@section('title', 'Video Categories')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Video Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Video Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Video Categories</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.video.categories.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Category
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body table-responsive p-0">
                            @if($categories->count() > 0)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Color</th>
                                            <th>Videos Count</th>
                                            <th>Sort Order</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($category->color)
                                                        <div class="color-indicator me-2" style="width: 20px; height: 20px; background-color: {{ $category->color }}; border-radius: 3px; border: 1px solid #ddd;"></div>
                                                    @endif
                                                    <strong>{{ $category->name }}</strong>
                                                </div>
                                                @if($category->description)
                                                    <small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($category->color)
                                                    <span class="badge" style="background-color: {{ $category->color }}; color: white;">{{ $category->color }}</span>
                                                @else
                                                    <span class="text-muted">No color</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $category->videos_count }}</span>
                                            </td>
                                            <td>{{ $category->sort_order }}</td>
                                            <td>
                                                @if($category->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.video.categories.show', $category) }}" class="btn btn-info btn-sm" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.video.categories.edit', $category) }}" class="btn btn-warning btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if($category->videos_count == 0)
                                                        <form action="{{ route('admin.video.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn btn-danger btn-sm" disabled title="Cannot delete category with videos">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="text-center p-4">
                                    <img src="{{ asset('admin/images/no-data.png') }}" alt="No data" class="mb-3" style="max-width: 200px;">
                                    <h4>No Video Categories Found</h4>
                                    <p class="text-muted">Start by creating your first video category.</p>
                                    <a href="{{ route('admin.video.categories.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add New Category
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        @if($categories->hasPages())
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                {{ $categories->links() }}
                            </div>
                            <div class="float-left">
                                <small class="text-muted">
                                    Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                                </small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('styles')
<style>
.color-indicator {
    display: inline-block;
    margin-right: 8px;
}
</style>
@endsection
