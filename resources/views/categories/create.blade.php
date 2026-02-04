@extends('layouts.app')

@section('title', 'Create Category - Samnang Coffee')

@section('styles')
<style>
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        max-width: 600px;
        margin: 2rem auto;
    }

    .form-header {
        background: linear-gradient(135deg, #d4a574 0%, #c99a5c 100%);
        color: white;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .form-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
    }

    .form-header i {
        font-size: 2.5rem;
    }

    .form-body {
        padding: 2rem 3rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .form-group label i {
        font-size: 1.1rem;
        color: #d4a574;
    }

    .form-group .required {
        color: #dc3545;
        font-weight: 700;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #d4a574;
        box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.1);
        outline: none;
    }

    .form-text {
        font-size: 0.85rem;
        color: #666;
        margin-top: 0.35rem;
        display: block;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 0.35rem;
        font-weight: 500;
    }

    .is-invalid {
        border-color: #dc3545 !important;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2.5rem;
        padding-top: 1rem;
        border-top: 2px solid #e0e0e0;
    }

    .btn {
        padding: 0.75rem 2rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #d4a574 0%, #c99a5c 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(212, 165, 116, 0.3);
    }

    .btn-secondary {
        background: #e0e0e0;
        color: #333;
    }

    .btn-secondary:hover {
        background: #d0d0d0;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <!-- Form Header -->
    <div class="form-header">
        <i class="bi bi-list"></i>
        <h1>New Category</h1>
    </div>

    <!-- Form Body -->
    <div class="form-body">
        <form method="POST" action="{{ route('categories.store') }}" class="needs-validation">
            @csrf

            <!-- Category Name -->
            <div class="form-group">
                <label for="name">
                    <i class="bi bi-tag"></i>
                    Category Name
                    <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    placeholder="e.g., Espresso Beans"
                    required
                >
                <small class="form-text">A unique name for this category</small>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">
                    <i class="bi bi-file-text"></i>
                    Description
                </label>
                <textarea 
                    class="form-control @error('description') is-invalid @enderror" 
                    id="description" 
                    name="description" 
                    rows="4"
                    placeholder="Describe this category..."
                >{{ old('description') }}</textarea>
                <small class="form-text">Optional: Add category details</small>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             
            <!-- Sort Order -->
            <div class="form-group">
                <label for="sort_order">
                    <i class="bi bi-sort-numeric-down"></i>
                    Sort Order
                </label>
                <input 
                    type="number" 
                    class="form-control @error('sort_order') is-invalid @enderror" 
                    id="sort_order" 
                    name="sort_order" 
                    value="{{ old('sort_order', 0) }}"
                    placeholder="0"
                >
                <small class="form-text">A lower number will appear first.</small>
                @error('sort_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
             <div>
                <label for="status">
                    <i class="bi bi-toggle-on"></i>
                    Status
                </label>
                <select 
                    class="form-control @error('status') is-invalid @enderror" 
                    id="status" 
                    name="status"
                >
                    <option value="active" @if(old('status', 'active') == 'active') selected @endif>Active</option>
                    <option value="inactive" @if(old('status', 'active') == 'inactive') selected @endif>Inactive</option>
                </select>
                <small class="form-text">Set the category status.</small>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
             </div>
            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>
                    Create Category
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection