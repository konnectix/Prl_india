@extends('admin.layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Video</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.video.videos.index') }}">Videos</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.video.videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Edit Video: {{ $video->title }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Video Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $video->title) }}" required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description', $video->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category <span class="text-danger">*</span></label>
                                            <select class="form-control @error('category_id') is-invalid @enderror" 
                                                    id="category_id" name="category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('category_id', $video->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="video_type">Video Type <span class="text-danger">*</span></label>
                                            <select class="form-control @error('video_type') is-invalid @enderror" 
                                                    id="video_type" name="video_type" required>
                                                <option value="">Select Type</option>
                                                <option value="youtube" {{ old('video_type', $video->video_type) == 'youtube' ? 'selected' : '' }}>YouTube</option>
                                                <option value="vimeo" {{ old('video_type', $video->video_type) == 'vimeo' ? 'selected' : '' }}>Vimeo</option>
                                                <option value="upload" {{ old('video_type', $video->video_type) == 'upload' ? 'selected' : '' }}>Upload File</option>
                                                <option value="external" {{ old('video_type', $video->video_type) == 'external' ? 'selected' : '' }}>External URL</option>
                                            </select>
                                            @error('video_type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- YouTube URL Input -->
                                <div class="form-group video-input" id="youtube_input" style="display: none;">
                                    <label for="youtube_url">YouTube URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" 
                                           id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $video->youtube_url) }}" 
                                           placeholder="https://www.youtube.com/watch?v=...">
                                    @error('youtube_url')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Enter the full YouTube video URL</small>
                                </div>

                                <!-- Vimeo URL Input -->
                                <div class="form-group video-input" id="vimeo_input" style="display: none;">
                                    <label for="vimeo_url">Vimeo URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control @error('vimeo_url') is-invalid @enderror" 
                                           id="vimeo_url" name="vimeo_url" value="{{ old('vimeo_url', $video->vimeo_url) }}" 
                                           placeholder="https://vimeo.com/...">
                                    @error('vimeo_url')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Enter the full Vimeo video URL</small>
                                </div>

                                <!-- External URL Input -->
                                <div class="form-group video-input" id="external_input" style="display: none;">
                                    <label for="external_url">External URL <span class="text-danger">*</span></label>
                                    <input type="url" class="form-control @error('external_url') is-invalid @enderror" 
                                           id="external_url" name="external_url" value="{{ old('external_url', $video->external_url) }}" 
                                           placeholder="https://example.com/video.mp4">
                                    @error('external_url')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Enter the direct video file URL</small>
                                </div>

                                <!-- Upload File Input -->
                                <div class="form-group video-input" id="upload_input" style="display: none;">
                                    <label for="video_file">Video File</label>
                                    @if($video->video_type === 'upload' && $video->video_path)
                                        <div class="alert alert-info">
                                            <strong>Current video file:</strong> {{ basename($video->video_path) }}
                                            <br><small class="text-muted">Upload a new file to replace the current one</small>
                                        </div>
                                    @endif
                                    <input type="file" class="form-control-file @error('video_file') is-invalid @enderror" 
                                           id="video_file" name="video_file" accept="video/*">
                                    @error('video_file')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Supported formats: MP4, AVI, MOV, WMV. Max size: 100MB</small>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="duration">Duration (seconds)</label>
                                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                                   id="duration" name="duration" value="{{ old('duration', $video->duration) }}" min="1">
                                            @error('duration')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Video duration in seconds (optional)</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="alt_text">Alt Text</label>
                                            <input type="text" class="form-control @error('alt_text') is-invalid @enderror" 
                                                   id="alt_text" name="alt_text" value="{{ old('alt_text', $video->alt_text) }}">
                                            @error('alt_text')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                            <small class="form-text text-muted">Alternative text for accessibility</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Current Thumbnail</h3>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{ $video->thumbnail_url }}" alt="{{ $video->alt_text ?? $video->title }}" 
                                     class="img-fluid rounded mb-3" style="max-height: 150px;">
                                
                                <div class="form-group">
                                    <label for="thumbnail">Upload New Thumbnail</label>
                                    <input type="file" class="form-control-file @error('thumbnail') is-invalid @enderror" 
                                           id="thumbnail" name="thumbnail" accept="image/*">
                                    @error('thumbnail')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">Upload new thumbnail to replace current one</small>
                                </div>
                            </div>
                        </div>

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Video Settings</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" {{ old('is_featured', $video->is_featured) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_featured">Featured Video</label>
                                    </div>
                                    <small class="form-text text-muted">Mark this video as featured</small>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ old('is_active', $video->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                    <small class="form-text text-muted">Only active videos will be shown on the frontend</small>
                                </div>

                                <div class="mt-3">
                                    <strong>Video Statistics:</strong>
                                    <ul class="list-unstyled mt-2">
                                        <li><i class="fas fa-eye text-primary"></i> Views: {{ number_format($video->view_count) }}</li>
                                        <li><i class="fas fa-calendar text-info"></i> Created: {{ $video->created_at->format('M d, Y') }}</li>
                                        <li><i class="fas fa-clock text-warning"></i> Updated: {{ $video->updated_at->format('M d, Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Preview</h3>
                            </div>
                            <div class="card-body">
                                <div id="video_preview">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <div id="preview_content">
                                            @if($video->embed_url)
                                                @if($video->video_type === 'youtube' || $video->video_type === 'vimeo' || $video->video_type === 'external')
                                                    <iframe src="{{ $video->embed_url }}" frameborder="0" allowfullscreen></iframe>
                                                @elseif($video->video_type === 'upload')
                                                    <video controls><source src="{{ $video->embed_url }}" type="video/mp4">Your browser does not support the video tag.</video>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div id="no_preview" class="text-center text-muted" style="display: none;">
                                    <i class="fas fa-video fa-3x mb-2"></i>
                                    <p>Select video type and enter URL to see preview</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Update Video
                                </button>
                                <a href="{{ route('admin.video.videos.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <a href="{{ route('admin.video.videos.show', $video) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> View Video
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Show/hide input fields based on video type
    $('#video_type').change(function() {
        const selectedType = $(this).val();
        
        // Hide all video inputs
        $('.video-input').hide();
        
        // Show selected input
        if (selectedType) {
            $(`#${selectedType}_input`).show();
        }
        
        // Update preview
        updatePreview();
    });

    // Update preview when URL changes
    $('#youtube_url, #vimeo_url, #external_url').on('input', function() {
        updatePreview();
    });

    function updatePreview() {
        const videoType = $('#video_type').val();
        let previewHTML = '';

        if (videoType === 'youtube') {
            const youtubeUrl = $('#youtube_url').val();
            if (youtubeUrl) {
                const videoId = extractYouTubeId(youtubeUrl);
                if (videoId) {
                    previewHTML = `<iframe src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                }
            }
        } else if (videoType === 'vimeo') {
            const vimeoUrl = $('#vimeo_url').val();
            if (vimeoUrl) {
                const videoId = extractVimeoId(vimeoUrl);
                if (videoId) {
                    previewHTML = `<iframe src="https://player.vimeo.com/video/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                }
            }
        } else if (videoType === 'external') {
            const externalUrl = $('#external_url').val();
            if (externalUrl) {
                previewHTML = `<video controls><source src="${externalUrl}" type="video/mp4">Your browser does not support the video tag.</video>`;
            }
        }

        if (previewHTML) {
            $('#preview_content').html(previewHTML);
            $('#video_preview').show();
            $('#no_preview').hide();
        } else if (!$('#preview_content').html().trim()) {
            $('#video_preview').hide();
            $('#no_preview').show();
        }
    }

    function extractYouTubeId(url) {
        const regex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }

    function extractVimeoId(url) {
        const regex = /(?:vimeo\.com\/)([0-9]+)/;
        const match = url.match(regex);
        return match ? match[1] : null;
    }

    // Trigger change event to show correct input on page load
    $('#video_type').trigger('change');
});
</script>
@endsection
