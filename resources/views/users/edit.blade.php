@extends('layouts.app')

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
    .card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
        border: none;
        padding: 1.5rem;
    }

    .card-header h4 {
        color: white;
        font-weight: 700;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.75rem;
    }

    .status-toggle {
        display: flex;
        gap: 1rem;
        margin-top: 0.75rem;
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
        padding: 0.75rem;
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
        font-size: 1.5rem;
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
        font-size: 0.9rem;
    }

    .btn {
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        border: none;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
    }

    .alert-info {
        background: linear-gradient(135deg, #cfe2ff 0%, #d6f0f7 100%);
        border: none;
        border-left: 4px solid #0c63e4;
        border-radius: 8px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit User</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Select a role</option>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>👤 User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>👑 Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Account Status -->
                        <div class="mb-3">
                            <label class="form-label">Account Status <span class="text-danger">*</span></label>
                            <div class="status-toggle">
                                <div class="status-option">
                                    <input 
                                        type="radio" 
                                        id="status_active" 
                                        name="status" 
                                        value="active"
                                        {{ old('status', $user->status) == 'active' ? 'checked' : '' }}
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
                                        {{ old('status', $user->status) == 'inactive' ? 'checked' : '' }}
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

                        <div class="alert alert-info">
                            <small><i class="bi bi-info-circle"></i> Leave password blank to keep the current password</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">Update User</button>
                            <a href="{{ route('users.show', $user) }}" class="btn btn-secondary">Cancel</a>
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