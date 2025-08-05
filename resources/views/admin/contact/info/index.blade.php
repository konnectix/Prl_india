@extends('admin.layouts.app')

@section('title', 'Contact Information')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Contact Information</h1>
    <a href="{{ route('admin.contact.info.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add New Info
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
                        <th>Label</th>
                        <th>Key</th>
                        <th>Value</th>
                        <th>Type</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contactInfo as $info)
                        <tr>
                            <td>
                                <strong>{{ $info->label }}</strong>
                                @if($info->icon)
                                    <br><small class="text-muted"><i class="{{ $info->icon }}"></i> {{ $info->icon }}</small>
                                @endif
                            </td>
                            <td><code>{{ $info->key }}</code></td>
                            <td>
                                @if($info->type === 'textarea')
                                    {{ Str::limit($info->value, 50) }}
                                @else
                                    {{ Str::limit($info->value, 30) }}
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($info->type) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst($info->section) }}</span>
                            </td>
                            <td>
                                @if($info->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $info->sort_order }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.contact.info.show', $info) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.contact.info.edit', $info) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    @if($info->is_active)
                                        <form method="POST" action="{{ route('admin.contact.info.toggle-status', $info) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-warning" title="Deactivate">
                                                <i class="fas fa-eye-slash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.contact.info.toggle-status', $info) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Activate">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.contact.info.destroy', $info) }}" 
                                          class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contact information?')">
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
                                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No contact information found</p>
                                <a href="{{ route('admin.contact.info.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Add First Contact Info
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contactInfo->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $contactInfo->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
