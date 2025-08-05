@extends('admin.layouts.app')

@section('title', 'Video Details')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Video: {{ $video->title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.video.videos.index') }}">Videos</a></li>
                        <li class="breadcrumb-item active">{{ Str::limit($video->title, 30) }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Video Preview</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.video.videos.edit', $video) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit Video
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="embed-responsive embed-responsive-16by9 mb-3">
                                @if($video->video_type === 'youtube')
                                    <iframe class="embed-responsive-item" src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                                @elseif($video->video_type === 'vimeo')
                                    <iframe class="embed-responsive-item" src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                                @elseif($video->video_type === 'upload')
                                    <video class="embed-responsive-item" controls>
                                        <source src="{{ $video->embed_url }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <iframe class="embed-responsive-item" src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>{{ $video->title }}</h4>
                                    @if($video->description)
                                        <p class="text-muted">{{ $video->description }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="border-right">
                                                <strong class="d-block">{{ number_format($video->view_count) }}</strong>
                                                <small class="text-muted">Views</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="border-right">
                                                <strong class="d-block">
                                                    @if($video->duration)
                                                        {{ gmdate('i:s', $video->duration) }}
                                                    @else
                                                        —
                                                    @endif
                                                </strong>
                                                <small class="text-muted">Duration</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <strong class="d-block">{{ $video->created_at->format('M d, Y') }}</strong>
                                            <small class="text-muted">Created</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($video->video_type === 'youtube' && $video->youtube_id)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">YouTube Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>YouTube ID:</strong>
                                    <code>{{ $video->youtube_id }}</code>
                                </div>
                                <div class="col-md-6">
                                    <strong>YouTube URL:</strong>
                                    <a href="{{ $video->youtube_url }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="fab fa-youtube"></i> Watch on YouTube
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Video Information</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Category:</strong></td>
                                    <td>
                                        @if($video->category)
                                            <a href="{{ route('admin.video.categories.show', $video->category) }}" class="badge" style="background-color: {{ $video->category->color ?? '#007bff' }}; color: white; text-decoration: none;">
                                                {{ $video->category->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">No category</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Type:</strong></td>
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
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <form action="{{ route('admin.video.videos.toggle-status', $video) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-{{ $video->is_active ? 'success' : 'secondary' }}">
                                                {{ $video->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Featured:</strong></td>
                                    <td>
                                        <form action="{{ route('admin.video.videos.toggle-featured', $video) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-{{ $video->is_featured ? 'warning' : 'outline-warning' }}">
                                                <i class="fas fa-star"></i> {{ $video->is_featured ? 'Featured' : 'Not Featured' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @if($video->alt_text)
                                <tr>
                                    <td><strong>Alt Text:</strong></td>
                                    <td>{{ $video->alt_text }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td><strong>Created:</strong></td>
                                    <td>{{ $video->created_at->format('M d, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated:</strong></td>
                                    <td>{{ $video->updated_at->format('M d, Y g:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Thumbnail</h3>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $video->thumbnail_url }}" alt="{{ $video->alt_text ?? $video->title }}" 
                                 class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Actions</h3>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.video.videos.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Videos
                                </a>
                                <a href="{{ route('admin.video.videos.edit', $video) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Video
                                </a>
                                @if($video->category)
                                    <a href="{{ route('admin.video.categories.show', $video->category) }}" class="btn btn-info">
                                        <i class="fas fa-folder"></i> View Category
                                    </a>
                                @endif
                                <a href="{{ route('frontend.video') }}#video-{{ $video->id }}" class="btn btn-success" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> View on Frontend
                                </a>
                                <form action="{{ route('admin.video.videos.destroy', $video) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this video?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Delete Video
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
