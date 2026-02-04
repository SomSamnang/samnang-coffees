@extends('layouts.app')

@section('title', 'Users - Samnang Coffee')

@section('styles')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
    <style>
    .page-header {
        background: linear-gradient(135deg, #6c3483 0%, #7d3c98 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 20px rgba(108, 52, 131, 0.2);
    }

    .page-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-create {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-create:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
        color: white;
    }

    .users-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .users-table {
        margin-bottom: 0;
    }

    .users-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .user-no {
        width: 60px;
        text-align: center;
        font-weight: 800;
        color: #6c3483;
    }

    .users-table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        color: #2c3e50;
        padding: 1.2rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .users-table td {
        padding: 1.2rem;
        border-color: #dee2e6;
        vertical-align: middle;
    }

    .users-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #dee2e6;
    }

    .users-table tbody tr:hover {
        background: #f8f9fa;
        box-shadow: inset 0 0 0 2px rgba(108, 52, 131, 0.05);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6c3483 0%, #7d3c98 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        margin-right: 0.5rem;
    }

    .user-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-email {
        color: #007bff;
        font-size: 0.95rem;
    }

    .role-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .role-admin {
        background: #cfe2ff;
        color: #084298;
    }

    .role-user {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
        background: #d1e7dd;
        color: #0f5132;
    }

    .created-date {
        color: #666;
        font-size: 0.95rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        font-size: 0.85rem;
        cursor: pointer;
    }

    .btn-view {
        background: #e8f4f8;
        color: #2c5aa0;
    }

    .btn-view:hover {
        background: #2c5aa0;
        color: white;
    }

    .btn-edit {
        background: #fff3cd;
        color: #856404;
    }

    .btn-edit:hover {
        background: #ffc107;
        color: white;
    }

    .btn-delete {
        background: #f8d7da;
        color: #842029;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 3rem;
        color: #6c3483;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #666;
        margin-bottom: 1.5rem;
    }

    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination .page-link {
        color: #6c3483;
        border-color: #dee2e6;
    }

    .pagination .page-link:hover {
        background: #6c3483;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #6c3483 0%, #7d3c98 100%);
        border-color: #6c3483;
    }

    .alert {
        border-radius: 8px;
        border: none;
        margin-bottom: 2rem;
    }

    .alert-success {
        background: #d1e7dd;
        color: #0f5132;
    }

    .alert-danger {
        background: #f8d7da;
        color: #842029;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-people"></i>
            User Management
        </h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('users.create') }}" class="btn-create">
                <i class="bi bi-plus-circle"></i>
                New User
            </a>
        @endif
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($users->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-person-slash"></i>
            <h3>No Users Found</h3>
            <p>No users have been added to the system yet.</p>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('users.create') }}" class="btn-create">
                    <i class="bi bi-plus-circle"></i>
                    Create First User
                </a>
            @endif
        </div>
    @else
        <!-- Users Table -->
        <div class="users-table-container">
            <table class="table users-table">
                <thead>
                    <tr>
                        <th class="user-no">No.</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Join Date</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="user-no">{{ $users->firstItem() ? $users->firstItem() + $loop->index : $loop->iteration }}</td>
                            <td>
                                <div class="user-name">
                                    <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                    {{ $user->name }}
                                </div>
                            </td>
                            <td><span class="user-email">{{ $user->email }}</span></td>
                            <td>
                                <span class="role-badge {{ $user->isAdmin() ? 'role-admin' : 'role-user' }}">
                                    @if($user->isAdmin())
                                        <i class="fa-solid fa-user-tie"></i> Admin
                                    @else
                                        <i class="bi bi-person"></i> User
                                    @endif
                                </span>
                            </td>
                            <td>
                                @if(isset($user->status) && $user->status === 'inactive')
                                    <span class="status-badge" style="background: #f8d7da; color: #842029;">
                                        <i class="bi bi-x-circle-fill" style="font-size:0.7rem; margin-right:6px;"></i>
                                        Inactive
                                    </span>
                                @else
                                    <span class="status-badge" style="background: #d1e7dd; color: #0f5132;">
                                        <i class="bi bi-circle-fill" style="font-size:0.6rem; margin-right:6px;"></i>
                                        Active
                                    </span>
                                @endif
                            </td>
                            <td><span class="created-date">{{ $user->created_at->format('M d, Y') }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('users.show', $user) }}" class="btn-action btn-view" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('users.edit', $user) }}" class="btn-action btn-edit" title="Edit">
                                           <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        @if(auth()->user()->id !== $user->id)
                                            <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
            <nav class="mt-4">
                {{ $users->links() }}
            </nav>
        @endif
    @endif
</div>
@endsection

</body>
</html>