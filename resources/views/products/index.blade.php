@extends('layouts.app')

@section('title', 'Products - Samnang Coffee')

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

    .products-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .products-table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        color: #2c3e50;
        padding: 1.2rem;
        font-size: 0.9rem;
        text-transform: uppercase;
    }

    .products-table td {
        padding: 1.2rem;
        vertical-align: middle;
    }

    .product-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
    }

    .product-category {
        font-size: 0.9rem;
        color: #666;
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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.85rem;
    }

    .btn-view { background: #e8f4f8; color: #2c5aa0; }
    .btn-edit { background: #fff3cd; color: #856404; }
    .btn-delete { background: #f8d7da; color: #842029; }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1><i class="bi bi-cup-hot"></i> Products</h1>
        <a href="{{ route('products.create') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i> New Product
        </a>
    </div>

    <div class="mb-4 d-flex justify-content-end">
        <form action="{{ route('products.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}" style="width: 250px;">
            <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            @if(request('search'))
                <a href="{{ route('products.index') }}" class="btn btn-secondary"><i class="bi bi-x-lg"></i></a>
            @endif
        </form>
    </div>

    @if($products->isEmpty())
        <div class="text-center p-5 bg-white rounded shadow-sm">
            <i class="bi bi-cup-hot" style="font-size: 3rem; color: #d4a574;"></i>
            <h3 class="mt-3">No Products Found</h3>
            <p class="text-muted">Get started by creating your first product.</p>
        </div>
    @else
        <div class="products-table-container">
            <table class="table products-table mb-0">
                <thead>
                    <tr>
                       <th>Id</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #ccc;">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="product-name">{{ $product->name }}</div>
                                <small class="text-muted">{{ $product->sku }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Uncategorized' }}</span></td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <span class="badge bg-{{ $product->is_active ? 'success' : 'danger' }}">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('products.show', $product) }}" class="btn-action btn-view"><i class="bi bi-eye"></i></a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn-action btn-edit"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?');" style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    @endif
</div>
@endsection