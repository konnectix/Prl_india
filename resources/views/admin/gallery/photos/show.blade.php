@extends('admin.layouts.app')

@section('title', $photo->title . ' - Photo Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">{{ $photo->title }}</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.gallery.photos.edit', $photo) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Photo
        </a>
        <a href="{{ route('admin.gallery.photos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Photos
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Photo Display</h6>
            </div>
            <div class="card-body text-center">
                @if($photo->image_path)
                    <img src="{{ asset('storage/' . $photo->image_path) }}" 
                         class="img-fluid rounded shadow" 
                         alt="{{ $photo->alt_text ?? $photo->title }}"
                         style="max-height: 500px;">
                @elseif($photo->image_url)
                    <img src="{{ $photo->image_url }}" 
                         class="img-fluid rounded shadow" 
                         alt="{{ $photo->alt_text ?? $photo->title }}"
                         style="max-height: 500px;">
                @else
                    <div class="bg-light p-5 rounded">
                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Image Available</h5>
                    </div>
                @endif
            </div>
        </div>
        
        @if($photo->description)
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Description</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $photo->description }}</p>
                </div>
            </div>
        @endif
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Photo Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Title:</strong></td>
                        <td>{{ $photo->title }}</td>
                    </tr>
                    <tr>
                        <td><strong>Category:</strong></td>
                        <td>
                            <a href="{{ route('admin.gallery.categories.show', $photo->category) }}" 
                               class="text-decoration-none">
                                {{ $photo->category->name }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if($photo->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Sort Order:</strong></td>
                        <td>{{ $photo->sort_order }}</td>
                    </tr>
                    @if($photo->alt_text)
                        <tr>
                            <td><strong>Alt Text:</strong></td>
                            <td>{{ $photo->alt_text }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td><strong>Image Source:</strong></td>
                        <td>
                            @if($photo->image_path)
                                <span class="badge bg-info">Uploaded</span>
                            @elseif($photo->image_url)
                                <span class="badge bg-warning">External URL</span>
                            @else
                                <span class="badge bg-secondary">None</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Created:</strong></td>
                        <td>{{ $photo->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Updated:</strong></td>
                        <td>{{ $photo->updated_at->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        @if($photo->image_path)
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">File Information</h6>
                </div>
                <div class="card-body">
                    <p><strong>Filename:</strong> {{ basename($photo->image_path) }}</p>
                    <p><strong>Path:</strong> <code>{{ $photo->image_path }}</code></p>
                    @if(file_exists(storage_path('app/public/' . $photo->image_path)))
                        @php
                            $filePath = storage_path('app/public/' . $photo->image_path);
                            $fileSize = filesize($filePath);
                            $imageInfo = getimagesize($filePath);
                        @endphp
                        <p><strong>File Size:</strong> {{ number_format($fileSize / 1024, 2) }} KB</p>
                        @if($imageInfo)
                            <p><strong>Dimensions:</strong> {{ $imageInfo[0] }} × {{ $imageInfo[1] }} px</p>
                            <p><strong>Type:</strong> {{ $imageInfo['mime'] }}</p>
                        @endif
                    @endif
                </div>
            </div>
        @elseif($photo->image_url)
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">External URL</h6>
                </div>
                <div class="card-body">
                    <p><strong>URL:</strong></p>
                    <code class="small">{{ $photo->image_url }}</code>
                    <div class="mt-2">
                        <a href="{{ $photo->image_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt me-1"></i>Open Original
                        </a>
                    </div>
                </div>
            </div>
        @endif
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.gallery.photos.edit', $photo) }}" 
                   class="btn btn-primary btn-sm w-100 mb-2">
                    <i class="fas fa-edit me-2"></i>Edit Photo
                </a>
                <a href="{{ route('admin.gallery.categories.show', $photo->category) }}" 
                   class="btn btn-info btn-sm w-100 mb-2">
                    <i class="fas fa-folder me-2"></i>View Category
                </a>
                <form method="POST" action="{{ route('admin.gallery.photos.destroy', $photo) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this photo?')" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm w-100">
                        <i class="fas fa-trash me-2"></i>Delete Photo
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
