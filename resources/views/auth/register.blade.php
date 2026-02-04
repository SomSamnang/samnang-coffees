@extends('layouts.app')

@section('title', 'Register - Samnang Coffee')

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
    .role-selector {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 1rem;
    }

    .role-option {
        position: relative;
    }

    .role-input {
        display: none;
    }

    .role-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.5rem;
        border: 2px solid #dee2e6;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        text-align: center;
    }

    .role-input:checked + .role-label {
        border-color: #6f4e37;
        background: linear-gradient(135deg, rgba(111, 78, 55, 0.05) 0%, rgba(139, 111, 71, 0.05) 100%);
        box-shadow: 0 4px 15px rgba(111, 78, 55, 0.15);
        transform: translateY(-2px);
    }

    .role-label:hover {
        border-color: #6f4e37;
        background: rgba(111, 78, 55, 0.02);
    }

    .role-label i {
        font-size: 2.5rem;
        color: #6f4e37;
    }

    .role-input:checked + .role-label i {
        color: #8b6f47;
    }

    .role-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1rem;
    }

    .role-desc {
        font-size: 0.8rem;
        color: #666;
    }

    @media (max-width: 576px) {
        .role-selector {
            grid-template-columns: 1fr;
        }
    }

    .status-toggle {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .status-option {
        flex: 1;
        position: relative;
    }

    .status-input {
        display: none;
    }

    .status-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        border: 2px solid #dee2e6;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
        text-align: center;
    }

    .status-input:checked + .status-label {
        border-color: #28a745;
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.05) 0%, rgba(32, 201, 151, 0.05) 100%);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.15);
        transform: translateY(-2px);
    }

    .status-label:hover {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.02);
    }

    .status-label i {
        font-size: 1.8rem;
    }

    .status-input[value="active"] + .status-label i {
        color: #28a745;
    }

    .status-input[value="inactive"] + .status-label i {
        color: #dc3545;
    }

    .status-input:checked + .status-label i {
        color: #20c997;
    }

    .status-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 0.95rem;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header bg-light">
                    <h4 class="card-title mb-0 text-center pt-2">☕ Samnang Coffee</h4>
                    <p class="text-center text-muted small mb-0 pb-2">Create a new account</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}"
                                placeholder="Enter your full name"
                                required
                                autofocus
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password"
                                placeholder="Enter a password (min. 8 characters)"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation"
                                placeholder="Confirm your password"
                                required
                            >
                        </div>

                        <!-- User Role -->
                        <div class="mb-4">
                            <label class="form-label">Account Type</label>
                            <div class="role-selector">
                                <div class="role-option">
                                    <input 
                                        type="radio" 
                                        id="role_user" 
                                        name="role" 
                                        value="user" 
                                        checked
                                        class="role-input"
                                    >
                                    <label for="role_user" class="role-label">
                                        <i class="bi bi-person-circle"></i>
                                        <span class="role-name">👤 Regular User</span>
                                        <span class="role-desc">Standard account access</span>
                                    </label>
                                </div>

                                <div class="role-option">
                                    <input 
                                        type="radio" 
                                        id="role_admin" 
                                        name="role" 
                                        value="admin"
                                        class="role-input"
                                    >
                                    <label for="role_admin" class="role-label">
                                        <i class="bi bi-shield-check"></i>
                                        <span class="role-name">👑 Administrator</span>
                                        <span class="role-desc">Full system access & management</span>
                                    </label>
                                </div>
                            </div>
                            @error('role')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Account Status -->
                        <div class="mb-4">
                            <label class="form-label">Account Status</label>
                            <div class="status-toggle">
                                <div class="status-option">
                                    <input 
                                        type="radio" 
                                        id="status_active" 
                                        name="status" 
                                        value="active" 
                                        checked
                                        class="status-input"
                                    >
                                    <label for="status_active" class="status-label">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <span class="status-name">🟢 Active</span>
                                    </label>
                                </div>

                                <div class="status-option">
                                    <input 
                                        type="radio" 
                                        id="status_inactive" 
                                        name="status" 
                                        value="inactive"
                                        class="status-input"
                                    >
                                    <label for="status_inactive" class="status-label">
                                        <i class="bi bi-x-circle-fill"></i>
                                        <span class="status-name">🔴 Inactive</span>
                                    </label>
                                </div>
                            </div>
                            @error('status')
                                <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Register
                        </button>

                        <!-- Links -->
                        <div class="text-center">
                            <p class="small">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    Login here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>
