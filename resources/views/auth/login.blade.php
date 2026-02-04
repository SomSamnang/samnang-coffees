@extends('layouts.app')

@section('title', 'Login - Samnang Coffee')

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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mt-5">
                <div class="card-header bg-light">
                    <h4 class="card-title mb-0 text-center pt-2">☕ Samnang Coffee</h4>
                    <p class="text-center text-muted small mb-0 pb-2">Login to your account</p>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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
                                autofocus
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
                                placeholder="Enter your password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input 
                                type="checkbox" 
                                class="form-check-input" 
                                id="remember" 
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Login
                        </button>

                        <!-- Links -->
                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none small">
                                    Forgot your password?
                                </a>
                                <span class="mx-2">|</span>
                            @endif
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-decoration-none small">
                                    Create an account
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Demo Credentials -->
            <div class="alert alert-info mt-4" role="alert">
                <strong>Demo Account:</strong><br>
                Email: admin@samnang.test<br>
                Password: password
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>

