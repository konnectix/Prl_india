@extends('admin.layouts.app')

@section('title', 'Videos Management')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Videos Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Videos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Filters -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filters</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.video.videos.index') }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Search</label>
                                            <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category_id" class="form-control">
                                                <option value="">All Categories</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Video Type</label>
                                            <select name="video_type" class="form-control">
                                                <option value="">All Types</option>
                                                <option value="youtube" {{ request('video_type') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                                <option value="vimeo" {{ request('video_type') == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                                <option value="upload" {{ request('video_type') == 'upload' ? 'selected' : '' }}>Upload</option>
                                                <option value="external" {{ request('video_type') == 'external' ? 'selected' : '' }}>External</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="">All Status</option>
                                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-block">
                                                    <i class="fas fa-search"></i> Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Manage Videos</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.video.videos.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New Video
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            @if($videos->count() > 0)
                                <form id="bulkForm" action="{{ route('admin.video.videos.bulk-delete') }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <button type="button" id="selectAll" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-check-square"></i> Select All
                                            </button>
                                            <button type="submit" id="bulkDelete" class="btn btn-sm btn-danger" style="display: none;" onclick="return confirm('Are you sure you want to delete selected videos?')">
                                                <i class="fas fa-trash"></i> Delete Selected
                                            </button>
                                        </div>
                                        <div>
                                            <span class="text-muted">Total: {{ $videos->total() }} videos</span>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="30">
                                                        <input type="checkbox" id="masterCheckbox">
                                                    </th>
                                                    <th width="80">Thumbnail</th>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Type</th>
                                                    <th>Duration</th>
                                                    <th>Views</th>
                                                    <th>Status</th>
                                                    <th>Created</th>
                                                    <th width="150">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($videos as $video)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="video_ids[]" value="{{ $video->id }}" class="video-checkbox">
                                                    </td>
                                                    <td>
                                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" 
                                                             class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <strong>{{ Str::limit($video->title, 40) }}</strong>
                                                            @if($video->is_featured)
                                                                <span class="badge badge-warning ml-1">Featured</span>
                                                            @endif
                                                        </div>
                                                        @if($video->description)
                                                            <small class="text-muted">{{ Str::limit($video->description, 60) }}</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($video->category)
                                                            <span class="badge" style="background-color: {{ $video->category->color ?? '#007bff' }}; color: white;">
                                                                {{ $video->category->name }}
                                                            </span>
                                                        @else
                                                            <span class="text-muted">No category</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $typeColors = [
                                                                'youtube' => 'danger',
                                                                'vimeo' => 'info',
                                                                'upload' => 'success',
                                                                'external' => 'secondary'
                                                            ];
                                                        @endphp
                                                        <span class="badge badge-{{ $typeColors[$video->video_type] ?? 'secondary' }}">
                                                            {{ ucfirst($video->video_type) }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @if($video->duration)
                                                            {{ gmdate('i:s', $video->duration) }}
                                                        @else
                                                            <span class="text-muted">—</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-light">{{ number_format($video->view_count) }}</span>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.video.videos.toggle-status', $video) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-{{ $video->is_active ? 'success' : 'secondary' }}" 
                                                                    title="Click to {{ $video->is_active ? 'deactivate' : 'activate' }}">
                                                                {{ $video->is_active ? 'Active' : 'Inactive' }}
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <td>{{ $video->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.video.videos.show', $video) }}" class="btn btn-info btn-sm" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.video.videos.edit', $video) }}" class="btn btn-warning btn-sm" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('admin.video.videos.toggle-featured', $video) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-sm btn-{{ $video->is_featured ? 'warning' : 'outline-warning' }}" 
                                                                        title="{{ $video->is_featured ? 'Remove from featured' : 'Mark as featured' }}">
                                                                    <i class="fas fa-star"></i>
                                                                </button>
                                                            </form>
                                                            <form action="{{ route('admin.video.videos.destroy', $video) }}" method="POST" class="d-inline" 
                                                                  onsubmit="return confirm('Are you sure you want to delete this video?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
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
                            @else
                                <div class="text-center p-4">
                                    <img src="{{ asset('admin/images/no-data.png') }}" alt="No data" class="mb-3" style="max-width: 200px;">
                                    <h4>No Videos Found</h4>
                                    <p class="text-muted">Start by creating your first video.</p>
                                    <a href="{{ route('admin.video.videos.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add New Video
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        @if($videos->hasPages())
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                {{ $videos->withQueryString()->links() }}
                            </div>
                            <div class="float-left">
                                <small class="text-muted">
                                    Showing {{ $videos->firstItem() }} to {{ $videos->lastItem() }} of {{ $videos->total() }} results
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

@section('scripts')
<script>
$(document).ready(function() {
    // Master checkbox functionality
    $('#masterCheckbox').change(function() {
        $('.video-checkbox').prop('checked', this.checked);
        toggleBulkActions();
    });

    // Individual checkbox functionality
    $('.video-checkbox').change(function() {
        toggleBulkActions();
        
        // Update master checkbox
        const total = $('.video-checkbox').length;
        const checked = $('.video-checkbox:checked').length;
        $('#masterCheckbox').prop('indeterminate', checked > 0 && checked < total);
        $('#masterCheckbox').prop('checked', checked === total);
    });

    // Select all button
    $('#selectAll').click(function() {
        $('.video-checkbox').prop('checked', true);
        $('#masterCheckbox').prop('checked', true);
        toggleBulkActions();
    });

    function toggleBulkActions() {
        const checkedCount = $('.video-checkbox:checked').length;
        if (checkedCount > 0) {
            $('#bulkDelete').show();
        } else {
            $('#bulkDelete').hide();
        }
    }
});
</script>
@endsection
