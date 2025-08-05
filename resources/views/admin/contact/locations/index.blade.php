@extends('admin.layouts.app')

@section('title', 'Contact Locations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Contact Locations</h1>
    <a href="{{ route('admin.contact.locations.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Location
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Default</th>
                        <th>Sort Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                        <tr>
                            <td>
                                <strong>{{ $location->name }}</strong>
                                <br><small class="text-muted">{{ $location->slug }}</small>
                            </td>
                            <td>{{ Str::limit($location->address, 50) }}</td>
                            <td>{{ $location->phone ?: '-' }}</td>
                            <td>{{ $location->email ?: '-' }}</td>
                            <td>
                                @if($location->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if($location->is_default)
                                    <span class="badge bg-warning text-dark">Default</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td>{{ $location->sort_order }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.contact.locations.show', $location) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.contact.locations.edit', $location) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if($location->is_active)
                                        <form method="POST" action="{{ route('admin.contact.locations.toggle-status', $location) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Deactivate">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.contact.locations.toggle-status', $location) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Activate">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </form>
                                    @endif

                                    @if(!$location->is_default)
                                        <form method="POST" action="{{ route('admin.contact.locations.set-default', $location) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Set as Default">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.contact.locations.destroy', $location) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this location?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No locations found</p>
                                <a href="{{ route('admin.contact.locations.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add First Location
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($locations->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $locations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
