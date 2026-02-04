@extends('layouts.app')

@section('title', 'Edit Order - Samnang Coffee')

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
    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #007bff 0%, #0dcaf0 100%);
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
        padding: 3rem;
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .form-group label i {
        font-size: 1.1rem;
        color: #007bff;
    }

    .form-group .required {
        color: #dc3545;
        font-weight: 700;
    }

    .form-control, .form-select {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
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

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 3rem;
        padding-top: 2rem;
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
        background: linear-gradient(135deg, #007bff 0%, #0dcaf0 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
    }

    .btn-secondary {
        background: #e0e0e0;
        color: #333;
    }

    .btn-secondary:hover {
        background: #d0d0d0;
    }

    @media (max-width: 768px) {
        .form-body {
            padding: 1.5rem;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .form-header {
            padding: 1.5rem;
        }

        .form-header h1 {
            font-size: 1.4rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <i class="bi bi-pencil-square"></i>
            <h1>Edit Order #{{ $order->id }}</h1>
        </div>

        <!-- Form Body -->
        <div class="form-body">
            <form method="POST" action="{{ route('orders.update', $order) }}" class="needs-validation">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <!-- Order Status -->
                    <div class="form-group">
                        <label for="status">
                            <i class="bi bi-tag"></i>
                            Status
                            <span class="required">*</span>
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
                            <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                        <small class="form-text">Current order status</small>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Order Total -->
                <div class="form-group">
                    <label for="total">
                        <i class="bi bi-currency-dollar"></i>
                        Order Total
                        <span class="required">*</span>
                    </label>
                    <input 
                        type="number" 
                        step="0.01"
                        class="form-control @error('total') is-invalid @enderror" 
                        id="total" 
                        name="total" 
                        value="{{ old('total', $order->total) }}"
                        required
                    >
                    <small class="form-text">Total amount in USD</small>
                    @error('total')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Notes -->
                <div class="form-group">
                    <label for="notes">
                        <i class="bi bi-chat-left-text"></i>
                        Notes
                    </label>
                    <textarea 
                        class="form-control @error('notes') is-invalid @enderror" 
                        id="notes" 
                        name="notes" 
                        rows="4"
                        placeholder="Add any special notes or instructions..."
                    >{{ old('notes', $order->notes) }}</textarea>
                    <small class="form-text">Optional: Add order notes or special requests</small>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Update Order
                    </button>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

</body>
</html>