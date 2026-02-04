@extends('layouts.app')

@section('title', 'Order #' . $order->id . ' - Samnang Coffee')

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
            <h2>Order #{{ $order->id }}</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Order Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Customer:</strong> {{ $order->customer ? $order->customer->name : 'Walk-in Customer' }}</p>
                    <p><strong>Email:</strong> {{ $order->customer ? $order->customer->email : 'N/A' }}</p>
                    <p><strong>Total:</strong> <span class="h5 text-success">${{ number_format($order->total, 2) }}</span></p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p><strong>Placed:</strong> {{ $order->placed_at->timezone('Asia/Phnom_Penh')->format('M d, Y H:i A') }}</p>
                    @if($order->notes)
                        <p><strong>Notes:</strong> {{ $order->notes }}</p>
                    @endif
                </div>
            </div>

            @if($order->items->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Order Items ({{ $order->items->count() }})</h5>
                    </div>
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td><a href="{{ route('products.show', $item->product) }}">{{ $item->product->name }}</a></td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->unit_price, 2) }}</td>
                                    <td>${{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    No items in this order.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

</body>
</html>