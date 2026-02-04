@extends('layouts.app')

@section('title', $product->name . ' - Samnang Coffee')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>{{ $product->name }}</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <p><strong>SKU:</strong> <code>{{ $product->sku }}</code></p>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p><strong>Price:</strong> <span class="h5 text-success">${{ number_format($product->price, 2) }}</span></p>
                    <p><strong>Stock:</strong> {{ $product->stock }} units</p>
                    <p><strong>Status:</strong> 
                        @if($product->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </p>
                    <hr>
                    <p><strong>Description:</strong></p>
                    <p>{{ $product->description ?? 'N/A' }}</p>
                    <hr>
                    <p class="text-muted small">Created: {{ $product->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</body>
</html>