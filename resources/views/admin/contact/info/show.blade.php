@extends('admin.layouts.app')

@section('title', 'Contact Info Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Contact Info Details</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.contact.info.edit', $info) }}" class="btn btn-primary">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="{{ route('admin.contact.info.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Back to List
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">{{ $info->label }}</h6>
                @if($info->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Key:</strong>
                    </div>
                    <div class="col-sm-9">
                        <code class="bg-light px-2 py-1 rounded">{{ $info->key }}</code>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Label:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $info->label }}
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Section:</strong>
                    </div>
                    <div class="col-sm-9">
                        <span class="badge bg-secondary">{{ ucfirst($info->section) }}</span>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Type:</strong>
                    </div>
                    <div class="col-sm-9">
                        <span class="badge bg-info">{{ ucfirst($info->type) }}</span>
                    </div>
                </div>

                @if($info->icon)
                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Icon:</strong>
                    </div>
                    <div class="col-sm-9">
                        <i class="{{ $info->icon }} me-2"></i>
                        <code>{{ $info->icon }}</code>
                    </div>
                </div>
                @endif

                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Value:</strong>
                    </div>
                    <div class="col-sm-9">
                        <div class="border rounded p-3 bg-light">
                            {!! $info->formatted_value !!}
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Raw Value:</strong>
                    </div>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="3" readonly>{{ $info->value }}</textarea>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-sm-3">
                        <strong>Sort Order:</strong>
                    </div>
                    <div class="col-sm-9">
                        {{ $info->sort_order ?? 'Not set' }}
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-sm-3">
                        <strong>Status:</strong>
                    </div>
                    <div class="col-sm-9">
                        @if($info->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Quick Actions</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('admin.contact.info.edit', $info) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Contact Info
                </a>
                
                <form method="POST" action="{{ route('admin.contact.info.destroy', $info) }}" 
                      onsubmit="return confirm('Are you sure you want to delete this contact info?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-trash me-2"></i>Delete Contact Info
                    </button>
                </form>

                <form method="POST" action="{{ route('admin.contact.info.toggle-status', $info) }}">
                    @csrf
                    @if($info->is_active)
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-pause me-2"></i>Mark as Inactive
                        </button>
                    @else
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-play me-2"></i>Mark as Active
                        </button>
                    @endif
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted">Created:</small><br>
                    {{ $info->created_at->format('M d, Y \a\t g:i A') }}
                </div>

                <div class="mb-3">
                    <small class="text-muted">Last Updated:</small><br>
                    {{ $info->updated_at->format('M d, Y \a\t g:i A') }}
                </div>

                @if($info->updated_at->diffInDays($info->created_at) > 0)
                <div class="mb-0">
                    <small class="text-muted">Last Modified:</small><br>
                    {{ $info->updated_at->diffForHumans() }}
                </div>
                @endif
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Preview</h6>
            </div>
            <div class="card-body">
                <div class="text-center p-3 border rounded bg-light">
                    @if($info->icon)
                        <i class="{{ $info->icon }} text-primary mb-2" style="font-size: 2rem;"></i><br>
                    @endif
                    <strong>{{ $info->label }}</strong><br>
                    <div class="mt-2">
                        {!! $info->formatted_value !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($relatedInfo->count() > 0)
<div class="card mt-4">
    <div class="card-header">
        <h6 class="mb-0">Related Contact Info in "{{ ucfirst($info->section) }}" Section</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($relatedInfo as $related)
                        @if($related->id !== $info->id)
                        <tr>
                            <td>
                                @if($related->icon)
                                    <i class="{{ $related->icon }} me-2"></i>
                                @endif
                                {{ $related->label }}
                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($related->type) }}</span>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;">
                                    {{ Str::limit($related->value, 50) }}
                                </div>
                            </td>
                            <td>
                                @if($related->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.contact.info.show', $related) }}" 
                                       class="btn btn-outline-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.contact.info.edit', $related) }}" 
                                       class="btn btn-outline-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
