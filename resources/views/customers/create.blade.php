@extends('layouts.app')

@section('title', 'Create Customer - Samnang Coffee')

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
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
        color: #28a745;
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
        border-color: #28a745;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
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
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
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
            <i class="bi bi-person-plus"></i>
            <h1>New Customer</h1>
        </div>

        <!-- Form Body -->
        <div class="form-body">
            <form method="POST" action="{{ route('customers.store') }}" class="needs-validation">
                @csrf

                <div class="form-row">
                    <!-- Customer Name -->
                    <div class="form-group">
                        <label for="name">
                            <i class="bi bi-person"></i>
                            Customer Name
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}"
                            placeholder="e.g., John Doe"
                            required
                        >
                        <small class="form-text">Full name of the customer</small>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">
                            <i class="bi bi-envelope"></i>
                            Email
                            <span class="required">*</span>
                        </label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="john@example.com"
                            required
                        >
                        <small class="form-text">Valid email address</small>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone">
                            <i class="bi bi-telephone"></i>
                            Phone
                        </label>
                        <input 
                            type="tel" 
                            class="form-control @error('phone') is-invalid @enderror" 
                            id="phone" 
                            name="phone" 
                            value="{{ old('phone') }}"
                            placeholder="+1 (555) 123-4567"
                        >
                        <small class="form-text">Customer phone number</small>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <label for="city">
                            <i class="bi bi-geo-alt"></i>
                            City
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('city') is-invalid @enderror" 
                            id="city" 
                            name="city" 
                            value="{{ old('city') }}"
                            placeholder="e.g., New York"
                        >
                        <small class="form-text">City of residence</small>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">
                        <i class="bi bi-houses"></i>
                        Address
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('address') is-invalid @enderror" 
                        id="address" 
                        name="address" 
                        value="{{ old('address') }}"
                        placeholder="Street address"
                    >
                    <small class="form-text">Full street address</small>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Postal Code -->
                <div class="form-group">
                    <label for="postal_code">
                        <i class="bi bi-mailbox"></i>
                        Postal Code
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('postal_code') is-invalid @enderror" 
                        id="postal_code" 
                        name="postal_code" 
                        value="{{ old('postal_code') }}"
                        placeholder="e.g., 10001"
                    >
                    <small class="form-text">ZIP or postal code</small>
                    @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Create Customer
                    </button>
                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
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