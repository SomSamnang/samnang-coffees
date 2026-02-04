@extends('layouts.app')

@section('title', 'Category Details - Samnang Coffee')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #d4a574 0%, #c99a5c 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 20px rgba(212, 165, 116, 0.2);
    }

    .page-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-back {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }

    .details-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        padding: 2rem;
    }

    .detail-row {
        display: flex;
        border-bottom: 1px solid #eee;
        padding: 1rem 0;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        width: 200px;
        font-weight: 700;
        color: #666;
    }

    .detail-value {
        flex: 1;
        color: #2c3e50;
        font-weight: 500;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1>
            <i class="bi bi-tag"></i>
            Category Details
        </h1>
        <a href="{{ route('categories.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="details-container">
        <div class="detail-row">
            <div class="detail-label">Name</div>
            <div class="detail-value">{{ $category->name }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Slug</div>
            <div class="detail-value">{{ $category->slug }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Sort Order</div>
            <div class="detail-value">{{ $category->sort_order }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Description</div>
            <div class="detail-value">{{ $category->description ?: 'No description provided' }}</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Status</div>
            <div class="detail-value">
                @if($category->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Created At</div>
            <div class="detail-value">{{ $category->created_at->format('F d, Y h:i A') }}</div>
        </div>

        <div class="mt-4 pt-3 border-top">
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning text-white">
                <i class="bi bi-pencil"></i> Edit Category
            </a>
        </div>
    </div>
</div>
@endsection