@extends('admin.layouts.app')

@section('title', 'Add New Contact Info')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Add New Contact Info</h1>
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
                <form method="POST" action="{{ route('admin.contact.info.store') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="key" class="form-label">Key <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('key') is-invalid @enderror" 
                               id="key" name="key" value="{{ old('key') }}" required>
                        @error('key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Unique identifier (e.g., support_phone, headquarters_address)</div>
                    </div>

                    <div class="mb-3">
                        <label for="label" class="form-label">Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('label') is-invalid @enderror" 
                               id="label" name="label" value="{{ old('label') }}" required>
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
                                <option value="{{ $value }}" {{ old('type') === $value ? 'selected' : '' }}>
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
                            <input type="text" class="form-control @error('value') is-invalid @enderror" 
                                   id="value" name="value" value="{{ old('value') }}" required>
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
                                <option value="{{ $value }}" {{ old('section') === $value ? 'selected' : '' }}>
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
                               id="icon" name="icon" value="{{ old('icon') }}"
                               placeholder="e.g., fas fa-phone, flaticon-mail">
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">FontAwesome or custom icon class</div>
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

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Contact Info
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
                <h6 class="mb-0">Preview</h6>
            </div>
            <div class="card-body">
                <div id="preview-section" class="text-muted">
                    <p>Select type and enter value to see preview</p>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">Examples</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled small">
                    <li><strong>Phone:</strong> +1 (555) 123-4567</li>
                    <li><strong>Email:</strong> contact@example.com</li>
                    <li><strong>Address:</strong> 123 Main St, City, State</li>
                    <li><strong>URL:</strong> https://example.com</li>
                    <li><strong>Text:</strong> Mon-Fri 9AM-5PM</li>
                </ul>
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
            let inputHtml = '';
            
            switch(type) {
                case 'textarea':
                    inputHtml = '<textarea class="form-control" id="value" name="value" rows="4" required>' + valueInput.value + '</textarea>';
                    break;
                case 'email':
                    inputHtml = '<input type="email" class="form-control" id="value" name="value" value="' + valueInput.value + '" required>';
                    break;
                case 'url':
                    inputHtml = '<input type="url" class="form-control" id="value" name="value" value="' + valueInput.value + '" required>';
                    break;
                case 'phone':
                    inputHtml = '<input type="tel" class="form-control" id="value" name="value" value="' + valueInput.value + '" required>';
                    break;
                default:
                    inputHtml = '<input type="text" class="form-control" id="value" name="value" value="' + valueInput.value + '" required>';
            }
            
            valueContainer.innerHTML = inputHtml;
            updatePreview();
        }
        
        function updatePreview() {
            const type = typeSelect.value;
            const value = document.getElementById('value').value;
            const icon = document.getElementById('icon').value;
            
            if (!type || !value) {
                previewSection.innerHTML = '<p class="text-muted">Select type and enter value to see preview</p>';
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
