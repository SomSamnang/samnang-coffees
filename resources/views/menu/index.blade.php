
@extends('layouts.app')

@section('title', 'Coffee Menu - Samnang Coffee')

@section('styles')
<style>
    :root {
        --brand-brown: #6f4e37;
        --brand-accent: #d4a574;
        --brand-light-bg: #f9f6f3;
        --text-dark: #2c3e50;
        --text-light: #6c757d;
        --border-color: #e9ecef;
    }

    .page-header {
        background: linear-gradient(135deg, var(--brand-brown) 0%, var(--brand-accent) 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
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

    .category-section {
        margin-bottom: 3rem;
    }

    .category-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--brand-brown);
        padding-bottom: 1rem;
        margin-bottom: 2rem;
        border-bottom: 3px solid var(--brand-accent);
        display: inline-block;
    }

    .products-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .menu-product-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        display: flex;
        gap: 1.5rem;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .menu-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .menu-product-image, .menu-product-image-placeholder {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .menu-product-image-placeholder {
        background-color: var(--brand-light-bg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--brand-accent);
        font-size: 2rem;
    }

    .menu-product-details {
        flex: 1;
    }

    .menu-product-name {
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .menu-product-description {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 0;
    }

    .menu-product-price {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--brand-brown);
        align-self: center;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1><i class="bi bi-book-half"></i> Our Menu</h1>
    </div>

    <div class="menu-container">
        @forelse($categories as $category)
            @if($category->products->isNotEmpty())
                <section class="category-section">
                    <h2 class="category-title">{{ $category->name }}</h2>
                    <div class="products-list">
                        @foreach($category->products as $product)
                            <div class="menu-product-card">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="menu-product-image">
                                @else
                                    <div class="menu-product-image-placeholder">
                                        <i class="bi bi-cup-hot"></i>
                                    </div>
                                @endif
                                <div class="menu-product-details">
                                    <h5 class="menu-product-name">{{ $product->name }}</h5>
                                    <p class="menu-product-description">{{ $product->description ?? 'A delicious coffee treat.' }}</p>
                                </div>
                                <div class="menu-product-price">
                                    ${{ number_format($product->price, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        @empty
            <div class="alert alert-info">No categories or products have been added to the menu yet.</div>
        @endforelse
    </div>
</div>
@endsection