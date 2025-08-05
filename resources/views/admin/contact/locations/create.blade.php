@extends('admin.layouts.app')

@section('title', 'Add New Location')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Add New Location</h1>
    <a href="{{ route('admin.contact.locations.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Locations
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Location Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.contact.locations.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Location Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="map_iframe_url" class="form-label">Google Maps Iframe URL</label>
                        <textarea class="form-control @error('map_iframe_url') is-invalid @enderror" 
                                  id="map_iframe_url" name="map_iframe_url" rows="3">{{ old('map_iframe_url') }}</textarea>
                        @error('map_iframe_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Paste the iframe URL from Google Maps</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="weekday_hours" class="form-label">Weekday Hours</label>
                                <input type="text" class="form-control @error('weekday_hours') is-invalid @enderror" 
                                       id="weekday_hours" name="weekday_hours" value="{{ old('weekday_hours') }}"
                                       placeholder="e.g., 08:00 AM to 06:00 PM">
                                @error('weekday_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="weekend_hours" class="form-label">Weekend Hours</label>
                                <input type="text" class="form-control @error('weekend_hours') is-invalid @enderror" 
                                       id="weekend_hours" name="weekend_hours" value="{{ old('weekend_hours') }}"
                                       placeholder="e.g., 09:00 AM to 05:00 PM">
                                @error('weekend_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="background_image" class="form-label">Background Image</label>
                        <input type="file" class="form-control @error('background_image') is-invalid @enderror" 
                               id="background_image" name="background_image" accept="image/*">
                        @error('background_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</div>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_default" name="is_default" 
                                   {{ old('is_default') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_default">
                                Set as Default Location
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Location
                        </button>
                        <a href="{{ route('admin.contact.locations.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Image Preview</h6>
            </div>
            <div class="card-body text-center">
                <div id="image_preview" style="display: none;">
                    <img id="preview_img" class="img-fluid rounded" style="max-height: 200px;">
                </div>
                <div id="no_preview" class="text-muted">
                    <i class="fas fa-image fa-3x mb-2"></i>
                    <p>No image selected</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li><i class="fas fa-info-circle text-info me-2"></i>Name will be used as tab title</li>
                    <li><i class="fas fa-info-circle text-info me-2"></i>Default location appears first</li>
                    <li><i class="fas fa-info-circle text-info me-2"></i>Sort order controls tab sequence</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('background_image');
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
