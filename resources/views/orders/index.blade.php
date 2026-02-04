@extends('layouts.app')

@section('title', 'Orders - Samnang Coffee')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #007bff 0%, #0dcaf0 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 12px;
        margin-bottom: 3rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.2);
    }

    .page-header h1 {
        margin: 0;
        font-size: 2.2rem;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .filter-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
        border-bottom: 2px solid #dee2e6;
    }

    .btn-filter {
        background: #f8f9fa;
        color: #2c3e50;
        border: 2px solid #dee2e6;
        border-radius: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 0.5rem 1.25rem;
        text-decoration: none;
    }

    .btn-filter:hover {
        background: #e9ecef;
        border-color: #adb5bd;
    }

    .btn-filter.active {
        background: linear-gradient(135deg, #007bff 0%, #0dcaf0 100%);
        color: white;
        border-color: #007bff;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
    }

    .category-badge-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 0;
        margin: 0;
        list-style: none;
        max-width: 250px;
    }

    .category-badge {
        background-color: #e7f3ff;
        color: #007bff;
        padding: 0.3rem 0.6rem;
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
        display: inline-block;
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

    .orders-table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .orders-table {
        margin-bottom: 0;
    }

    .orders-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .orders-table th {
        border-top: none;
        border-bottom: 2px solid #dee2e6;
        font-weight: 700;
        color: #2c3e50;
        padding: 1.2rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .orders-table td {
        padding: 1.2rem;
        border-color: #dee2e6;
        vertical-align: middle;
    }

    .orders-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #dee2e6;
    }

    .orders-table tbody tr:hover {
        background: #f8f9fa;
        box-shadow: inset 0 0 0 2px rgba(0, 123, 255, 0.05);
    }

    .order-id {
        font-weight: 700;
        color: #007bff;
        font-size: 1.1rem;
    }

    .order-customer {
        font-weight: 600;
        color: #2c3e50;
    }

    .order-amount {
        font-weight: 700;
        color: #28a745;
        font-size: 1.05rem;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-processing {
        background: #cfe2ff;
        color: #084298;
    }

    .status-completed {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #842029;
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
        background: #e7f3ff;
        color: #007bff;
    }

    .btn-view:hover {
        background: #007bff;
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

    .btn-print {
        background: #e2e6ea;
        color: #495057;
    }

    .btn-print:hover {
        background: #495057;
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
        color: #007bff;
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
        color: #007bff;
        border-color: #dee2e6;
    }

    .pagination .page-link:hover {
        background: #007bff;
        color: white;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #007bff 0%, #0dcaf0 100%);
        border-color: #007bff;
    }
</style>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1>
            <i class="bi bi-box-seam"></i>
            Orders Management
        </h1>
        <a href="{{ route('orders.pos') }}" class="btn-create">
            <i class="bi bi-plus-circle"></i>
            New Order
        </a>
    </div>

    <!-- Category Filters -->
    <div class="filter-buttons">
        <a href="{{ route('orders.index') }}" class="btn btn-filter {{ !request('category') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> All
        </a>
        @foreach($categories as $category)
            <a href="{{ route('orders.index', ['category' => $category->slug]) }}" 
               class="btn btn-filter {{ request('category') == $category->slug ? 'active' : '' }}">
                <i class="bi bi-tag"></i> {{ $category->name }}
            </a>
        @endforeach
    </div>

    @if($orders->isEmpty())
        <!-- Empty State -->
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>No Orders Yet</h3>
            <p>You haven't created any orders. Start by creating your first order.</p>
            <a href="{{ route('orders.create') }}" class="btn-create">
                <i class="bi bi-plus-circle"></i>
                Create First Order
            </a>
        </div>
    @else
        <!-- Orders Table -->
        <div class="orders-table-container">
            <table class="table orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date Placed</th>
                        <th style="width: 140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><span class="order-id">#{{ $order->id }}</span></td>
                            <td>
                                <div class="order-customer">{{ $order->customer->name ?? 'N/A' }}</div>
                                <small class="text-muted">{{ $order->customer->email ?? '' }}</small>
                            </td>
                            
                            <td><span class="order-amount">${{ number_format($order->total, 2) }}</span></td>
                            <td>
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    @if($order->status === 'pending')
                                        ⏳ Pending
                                    @elseif($order->status === 'processing')
                                        ⚙️ Processing
                                    @elseif($order->status === 'completed')
                                        ✅ Completed
                                    @else
                                        ❌ Cancelled
                                    @endif
                                </span>
                            </td>
                            <td>
                              <small class="text-muted fw-semibold">
<i class="bi bi-clock"></i>
{{ $order->created_at->timezone('Asia/Phnom_Penh')->format('d M Y | h:i A') }}
</small>

                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('orders.show', $order) }}" class="btn-action btn-view" title="View">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a href="{{ route('orders.invoice', $order) }}" class="btn-action btn-print" title="Print Invoice" target="_blank">
                                        <i class="bi bi-printer"></i> Print
                                    </a>
                                    <a href="{{ route('orders.edit', $order) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('orders.destroy', $order) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this order?');">
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
        @if($orders->hasPages())
            <nav class="mt-4">
                {{ $orders->links() }}
            </nav>
        @endif
    @endif
</div>
@endsection