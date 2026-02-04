@extends('layouts.app')

@section('title', 'Categories - Samnang Coffee')

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

    .btn-create {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-create:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        color: white;
    }

    .categories-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .categories-table {
        margin-bottom: 0;
    }

    .categories-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .categories-table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        color: #2c3e50;
        padding: 1.2rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .categories-table td {
        padding: 1.2rem;
        border-color: #dee2e6;
        vertical-align: middle;
    }

    .categories-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #dee2e6;
    }

    .categories-table tbody tr:hover {
        background: #f8f9fa;
        box-shadow: inset 0 0 0 2px rgba(212, 165, 116, 0.05);
    }

    .category-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .category-description {
        color: #666;
        font-size: 0.95rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .btn-view {
        background: #e8f4f8;
        color: #2c5aa0;
    }

    .btn-view:hover {
        background: #2c5aa0;
        color: white;
    }

    .btn-edit {
        background: #fff3cd;
        color: #856404;
    }

    .btn-edit:hover {
        background: #ffc107;
        color: white;
    }

    .btn-delete {
        background: #f8d7da;
        color: #842029;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 3rem;
        color: #d4a574;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 1.5rem;
    }

    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination .page-link {
        color: #d4a574;
        border-color: #dee2e6;
    }

    .pagination .page-link:hover {
        background: #d4a574;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #d4a574 0%, #c99a5c 100%);
        border-color: #d4a574;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-list"></i>
            Categories Management
        </h1>
        <a href="{{ route('categories.create') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i>
            New Category
        </a>
    </div>

    <!-- Search Filter -->
    <div class="mb-4 d-flex justify-content-end">
        <form action="{{ route('categories.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search categories..." value="{{ request('search') }}" style="width: 250px;">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('categories.index') }}" class="btn btn-secondary" title="Clear Search"><i class="bi bi-x-lg"></i></a>
            @endif
        </form>
    </div>

    @if($categories->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-folder"></i>
            <h3>No Categories Yet</h3>
            <p>You haven't created any product categories. Start by creating your first category.</p>
            <a href="{{ route('categories.create') }}" class="btn-create">
                <i class="bi bi-plus-circle"></i>
                Create First Category
            </a>
        </div>
    @else
      

        <!-- Categories Table -->
        <div class="categories-table-container">
            <table class="table categories-table">
                <thead>
                    <tr>
                         <th>ID</th>
                        <th>Image</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #ccc;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            
                            <td>
                                <div class="category-name">
                                    <i class="bi bi-tag"></i>
                                    {{ $category->name }}
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" role="switch" id="status-{{ $category->id }}" data-id="{{ $category->id }}" {{ $category->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status-{{ $category->id }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</label>
                                </div>
                            </td>
                            <td>
                                {{ $category->sort_order }}
                            </td>
                            <td>
                                <div class="category-description">
                                    {{ $category->description ?: 'No description' }}
                                </div>
                            </td>
                            <td>
                                <small class="text-muted fw-semibold">
                                    <i class="bi bi-clock"></i>
                                    {{ $category->created_at->timezone('Asia/Phnom_Penh')->format('d M Y | h:i A') }}
                                </small>
                            </td>   
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('categories.show', $category) }}" class="btn-action btn-view" title="View">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('categories.edit', $category) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Delete">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($categories->hasPages())
            <nav class="mt-4">
                {{ $categories->links() }}
            </nav>
        @endif
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggles = document.querySelectorAll('.status-toggle');
    
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const categoryId = this.dataset.id;
            const isChecked = this.checked;
            const label = this.nextElementSibling;
            
            // Optimistic UI update
            label.textContent = isChecked ? 'Active' : 'Inactive';

            // Send AJAX request
            fetch(`/categories/${categoryId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ is_active: isChecked })
            }).catch(error => {
                console.error('Error:', error);
                alert('Failed to update status');
                this.checked = !isChecked; // Revert on error
                label.textContent = !isChecked ? 'Active' : 'Inactive';
            });
        });
    });
});
</script>
@endsection