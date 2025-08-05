@extends('admin.layouts.app')

@section('title', 'Edit Contact Info')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Contact Info</h1>
    <a href="{{ route('admin.contact.info.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Contact Info
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Contact Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.contact.info.update', $info) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="key" class="form-label">Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('key') is-invalid @enderror" 
                               id="key" name="key" value="{{ old('key', $info->key) }}" required>
                        @error('key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Unique identifier (e.g., support_phone, headquarters_address)</div>
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" 
                               id="label" name="label" value="{{ old('label', $info->label) }}" required>
                        @error('label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Display name (e.g., Support Phone, Headquarters Address)</div>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" 
                                id="type" name="type" required>
                            <option value="">Select Type</option>
                            @foreach($types as $value => $label)
                                <option value="{{ $value }}" {{ old('type', $info->type) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                        <div id="value-input">
                            @if($info->type === 'textarea')
                                <textarea class="form-control @error('value') is-invalid @enderror" 
                                          id="value" name="value" rows="4" required>{{ old('value', $info->value) }}</textarea>
                            @elseif($info->type === 'email')
                                <input type="email" class="form-control @error('value') is-invalid @enderror" 
                                       id="value" name="value" value="{{ old('value', $info->value) }}" required>
                            @elseif($info->type === 'url')
                                <input type="url" class="form-control @error('value') is-invalid @enderror" 
                                       id="value" name="value" value="{{ old('value', $info->value) }}" required>
                            @elseif($info->type === 'phone')
                                <input type="tel" class="form-control @error('value') is-invalid @enderror" 
                                       id="value" name="value" value="{{ old('value', $info->value) }}" required>
                            @else
                                <input type="text" class="form-control @error('value') is-invalid @enderror" 
                                       id="value" name="value" value="{{ old('value', $info->value) }}" required>
                            @endif
                        </div>
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="section" class="form-label">Section <span class="text-danger">*</span></label>
                        <select class="form-select @error('section') is-invalid @enderror" 
                                id="section" name="section" required>
                            <option value="">Select Section</option>
                            @foreach($sections as $value => $label)
                                <option value="{{ $value }}" {{ old('section', $info->section) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('section')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon Class</label>
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                               id="icon" name="icon" value="{{ old('icon', $info->icon) }}"
                               placeholder="e.g., fas fa-phone, flaticon-mail">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">FontAwesome or custom icon class</div>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $info->sort_order) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                   {{ old('is_active', $info->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Active
                            </label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Contact Info
                        </button>
                        <a href="{{ route('admin.contact.info.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Current Info</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Key:</strong><br>
                    <code>{{ $info->key }}</code>
                </div>
                
                <div class="mb-3">
                    <strong>Current Status:</strong><br>
                    @if($info->is_active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </div>

                <div class="mb-3">
                    <strong>Section:</strong><br>
                    <span class="badge bg-secondary">{{ ucfirst($info->section) }}</span>
                </div>

                <div class="mb-3">
                    <strong>Type:</strong><br>
                    <span class="badge bg-info">{{ ucfirst($info->type) }}</span>
                </div>

                <div class="mb-3">
                    <strong>Created:</strong><br>
                    {{ $info->created_at->format('M d, Y') }}
                </div>

                <div class="mb-0">
                    <strong>Updated:</strong><br>
                    {{ $info->updated_at->format('M d, Y') }}
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Preview</h6>
            </div>
            <div class="card-body">
                <div id="preview-section">
                    {!! $info->formatted_value !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('type');
        const valueInput = document.getElementById('value');
        const valueContainer = document.getElementById('value-input');
        const previewSection = document.getElementById('preview-section');
        
        function updateValueInput() {
            const type = typeSelect.value;
            const currentValue = document.getElementById('value').value;
            let inputHtml = '';
            
            switch(type) {
                case 'textarea':
                    inputHtml = '<textarea class="form-control" id="value" name="value" rows="4" required>' + currentValue + '</textarea>';
                    break;
                case 'email':
                    inputHtml = '<input type="email" class="form-control" id="value" name="value" value="' + currentValue + '" required>';
                    break;
                case 'url':
                    inputHtml = '<input type="url" class="form-control" id="value" name="value" value="' + currentValue + '" required>';
                    break;
                case 'phone':
                    inputHtml = '<input type="tel" class="form-control" id="value" name="value" value="' + currentValue + '" required>';
                    break;
                default:
                    inputHtml = '<input type="text" class="form-control" id="value" name="value" value="' + currentValue + '" required>';
            }
            
            valueContainer.innerHTML = inputHtml;
            updatePreview();
        }
        
        function updatePreview() {
            const type = typeSelect.value;
            const value = document.getElementById('value').value;
            const icon = document.getElementById('icon').value;
            
            if (!type || !value) {
                return;
            }
            
            let previewHtml = '';
            if (icon) {
                previewHtml += '<i class="' + icon + ' me-2"></i>';
            }
            
            switch(type) {
                case 'email':
                    previewHtml += '<a href="mailto:' + value + '">' + value + '</a>';
                    break;
                case 'phone':
                    previewHtml += '<a href="tel:' + value.replace(/[^0-9+]/g, '') + '">' + value + '</a>';
                    break;
                case 'url':
                    previewHtml += '<a href="' + value + '" target="_blank">' + value + '</a>';
                    break;
                default:
                    previewHtml += value;
            }
            
            previewSection.innerHTML = previewHtml;
        }
        
        typeSelect.addEventListener('change', updateValueInput);
        document.addEventListener('input', function(e) {
            if (e.target.id === 'value' || e.target.id === 'icon') {
                updatePreview();
            }
        });
    });
</script>
@endsection
