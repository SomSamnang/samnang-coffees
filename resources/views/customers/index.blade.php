@extends('layouts.app')

@section('title', 'Customers - Samnang Coffee')

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
    .page-header {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.2);
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
        background: linear-gradient(135deg, #007bff 0%, #0dcaf0 100%);
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
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        color: white;
    }

    .customers-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .customers-table {
        margin-bottom: 0;
    }

    .customers-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .customers-table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        color: #2c3e50;
        padding: 1.2rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .customers-table td {
        padding: 1.2rem;
        border-color: #dee2e6;
        vertical-align: middle;
    }

    .customers-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #dee2e6;
    }

    .customers-table tbody tr:hover {
        background: #f8f9fa;
        box-shadow: inset 0 0 0 2px rgba(40, 167, 69, 0.05);
    }

    .customer-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.05rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .customer-email {
        color: #007bff;
        font-size: 0.95rem;
    }

    .customer-phone {
        color: #666;
        font-family: 'Courier New', monospace;
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
        color: #28a745;
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
        color: #28a745;
        border-color: #dee2e6;
    }

    .pagination .page-link:hover {
        background: #28a745;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-color: #28a745;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-people"></i>
            Customers Management
        </h1>
        <a href="{{ route('customers.create') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i>
            New Customer
        </a>
    </div>

    @if($customers->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-person-plus"></i>
            <h3>No Customers Yet</h3>
            <p>You haven't added any customers. Start by adding your first customer.</p>
            <a href="{{ route('customers.create') }}" class="btn-create">
                <i class="bi bi-plus-circle"></i>
                Add First Customer
            </a>
        </div>
    @else
        <!-- Customers Table -->
        <div class="customers-table-container">
            <table class="table customers-table">
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                        <tr>
                            <td>
                                <div class="customer-name">
                                    <i class="bi bi-person"></i>
                                    {{ $customer->name }}
                                </div>
                            </td>
                            <td><span class="customer-email">{{ $customer->email }}</span></td>
                            <td><span class="customer-phone">{{ $customer->phone ?? 'N/A' }}</span></td>
                            <td>{{ $customer->city ?? 'N/A' }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('customers.show', $customer) }}" class="btn-action btn-view" title="View">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('customers.edit', $customer) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('customers.destroy', $customer) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Delete">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($customers->hasPages())
            <nav class="mt-4">
                {{ $customers->links() }}
            </nav>
        @endif
    @endif
</div>
@endsection

</body>
</html>