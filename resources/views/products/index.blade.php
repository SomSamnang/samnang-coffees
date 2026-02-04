@extends('layouts.app')

@section('title', 'Products - Samnang Coffee')

@section('styles')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
    .page-header {
        background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 20px rgba(111, 78, 55, 0.2);
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

    .products-table {
        margin-bottom: 0;
    }

    .products-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .products-table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        color: #2c3e50;
        padding: 1.2rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .products-table td {
        padding: 1.2rem;
        border-color: #dee2e6;
        vertical-align: middle;
    }

    .products-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #dee2e6;
    }

    .products-table tbody tr:hover {
        background: #f8f9fa;
        box-shadow: inset 0 0 0 2px rgba(111, 78, 55, 0.05);
    }

    .product-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .product-sku {
        background: #f8f9fa;
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #6f4e37;
        font-size: 0.85rem;
    }

    .product-category {
        background: #e8f4f8;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        color: #2c5aa0;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .product-price {
        font-weight: 700;
        color: #6f4e37;
        font-size: 1.1rem;
    }

    .stock-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .stock-high {
        background: #d1e7dd;
        color: #0f5132;
    }

    .stock-low {
        background: #fff3cd;
        color: #856404;
    }

    .stock-out {
        background: #f8d7da;
        color: #842029;
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
        color: #6f4e37;
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
        color: #6f4e37;
        border-color: #dee2e6;
    }

    .pagination .page-link:hover {
        background: #6f4e37;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
        border-color: #6f4e37;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-cup-hot"></i>
            Products Management
        </h1>
        <a href="{{ route('products.create') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i>
            New Product
        </a>
    </div>

    @if($products->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-box"></i>
            <h3>No Products Yet</h3>
            <p>You haven't added any products. Start by creating your first product.</p>
            <a href="{{ route('products.create') }}" class="btn-create">
                <i class="bi bi-plus-circle"></i>
                Create First Product
            </a>
        </div>
    @else
    <!-- Products Table Search -->
    <div class="mb-3">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

        <!-- Products Table -->
        <div class="products-table-container">
            <table class="table products-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>SKU</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>

                            <td>
                                <div class="product-name">
                                    <i class="bi bi-cup-hot"></i>
                                    {{ $product->name }}
                                </div>
                            </td>
                            <td><span class="product-sku">{{ $product->sku }}</span></td>
                            <td><span class="product-category">{{ $product->category->name }}</span></td>
                            <td><span class="product-price">${{ number_format($product->price, 2) }}</span></td>
                            <td>
                                <span class="stock-badge {{ $product->stock > 20 ? 'stock-high' : ($product->stock > 5 ? 'stock-low' : 'stock-out') }}">
                                    {{ $product->stock }} units
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('products.show', $product) }}" class="btn-action btn-view" title="View">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
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
        @if($products->hasPages())
            <nav class="mt-4">
                {{ $products->links() }}
            </nav>
        @endif
    @endif
</div>
@endsection

</body>
</html>