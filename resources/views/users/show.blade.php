@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">User Details</h4>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted">Name</label>
                            <p class="fs-5"><strong>{{ $user->name }}</strong></p>
                            <p class="fs-6"><strong>Status:</strong> {{ isset($user->status) ? ucfirst($user->status) : 'Active' }}</p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Email</label>
                            <p class="fs-5"><strong>{{ $user->email }}</strong></p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Role</label>
                            <p class="fs-5">
                                @if($user->isAdmin())
                                    <span class="badge bg-danger">Admin</span>
                                @else
                                    <span class="badge bg-secondary">User</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted">Status</label>
                            <p class="fs-5">
                                @if(isset($user->status) && $user->status === 'inactive')
                                    <span class="badge" style="background:#f8d7da;color:#842029;">Inactive</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="text-muted">Created At</label>
                            <p class="fs-5"><strong>{{ $user->created_at->format('M d, Y H:i A') }}</strong></p>
                        </div>
                        <div class="col-md-6">
                            <label class="text-muted">Last Updated</label>
                            <p class="fs-5"><strong>{{ $user->updated_at->format('M d, Y H:i A') }}</strong></p>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                        @if(auth()->user()->isAdmin() && auth()->user()->id !== $user->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete User
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>
