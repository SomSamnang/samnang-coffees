@extends('layouts.app')

@section('title', $customer->name . ' - Samnang Coffee')

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
            <h2>{{ $customer->name }}</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Customer Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></p>
                    <p><strong>Phone:</strong> {{ $customer->phone ?? 'N/A' }}</p>
                    <p><strong>Address:</strong> {{ $customer->address ?? 'N/A' }}</p>
                    <p><strong>City:</strong> {{ $customer->city ?? 'N/A' }}</p>
                    <p><strong>Postal Code:</strong> {{ $customer->postal_code ?? 'N/A' }}</p>
                    <hr>
                    <p class="text-muted small">Created: {{ $customer->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>

            @if($customer->orders->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Orders ({{ $customer->orders->count() }})</h5>
                    </div>
                    <table class="table table-sm mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->placed_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    No orders yet.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
 
</body>
</html>