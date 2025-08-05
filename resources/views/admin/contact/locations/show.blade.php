@extends('admin.layouts.app')

@section('title', 'Location Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0">{{ $location->name }}</h1>
        <p class="text-muted mb-0">Location Details</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.contact.locations.edit', $location) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit Location
        </a>
        <a href="{{ route('admin.contact.locations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to Locations
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if($location->background_image)
                    <div class="mb-4 text-center">
                        <img src="{{ asset('storage/' . $location->background_image) }}" 
                             class="img-fluid rounded" style="max-height: 300px;">
                    </div>
                @endif

                <div class="mb-4">
                    <h5>Address</h5>
                    <p class="text-muted">{!! nl2br(e($location->address)) !!}</p>
                </div>

                @if($location->phone || $location->email)
                    <div class="mb-4">
                        <h5>Contact Information</h5>
                        @if($location->phone)
                            <p><strong>Phone:</strong> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $location->phone) }}">{{ $location->phone }}</a></p>
                        @endif
                        @if($location->email)
                            <p><strong>Email:</strong> <a href="mailto:{{ $location->email }}">{{ $location->email }}</a></p>
                        @endif
                    </div>
                @endif

                @if($location->weekday_hours || $location->weekend_hours)
                    <div class="mb-4">
                        <h5>Office Hours</h5>
                        @if($location->weekday_hours)
                            <p><strong>Weekdays:</strong> {{ $location->weekday_hours }}</p>
                        @endif
                        @if($location->weekend_hours)
                            <p><strong>Weekends:</strong> {{ $location->weekend_hours }}</p>
                        @endif
                    </div>
                @endif

                @if($location->map_iframe_url)
                    <div class="mb-4">
                        <h5>Location Map</h5>
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $location->map_iframe_url }}" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy">
                            </iframe>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Location Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Name:</strong><br>
                    {{ $location->name }}
                </div>

                <div class="mb-3">
                    <strong>Slug:</strong><br>
                    <code>{{ $location->slug }}</code>
                </div>

                <div class="mb-3">
                    <strong>Status:</strong><br>
                    @if($location->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Default Location:</strong><br>
                    @if($location->is_default)
                        <span class="badge bg-warning text-dark">Yes</span>
                    @else
                        <span class="badge bg-secondary">No</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Sort Order:</strong><br>
                    {{ $location->sort_order }}
                </div>

                <div class="mb-3">
                    <strong>Created:</strong><br>
                    {{ $location->created_at->format('M d, Y g:i A') }}
                </div>

                <div class="mb-0">
                    <strong>Last Updated:</strong><br>
                    {{ $location->updated_at->format('M d, Y g:i A') }}
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.contact.locations.edit', $location) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Location
                    </a>
                    
                    @if($location->is_active)
                        <form method="POST" action="{{ route('admin.contact.locations.toggle-status', $location) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-warning w-100" 
                                    onclick="return confirm('Are you sure you want to deactivate this location?')">
                                <i class="fas fa-eye-slash me-2"></i>Deactivate
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.contact.locations.toggle-status', $location) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-eye me-2"></i>Activate
                            </button>
                        </form>
                    @endif

                    @if(!$location->is_default)
                        <form method="POST" action="{{ route('admin.contact.locations.set-default', $location) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-outline-warning w-100">
                                <i class="fas fa-star me-2"></i>Set as Default
                            </button>
                        </form>
                    @endif

                    <hr>

                    <form method="POST" action="{{ route('admin.contact.locations.destroy', $location) }}" 
                          onsubmit="return confirm('Are you sure you want to delete this location? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="fas fa-trash me-2"></i>Delete Location
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
