@extends('layouts.app')

@section('title', 'Dashboard - Samnang Coffee')

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
    /* Dashboard Custom Styles */
    .dashboard-header {
        background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 15px;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(111, 78, 55, 0.2);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .dashboard-header .content {
        position: relative;
        z-index: 1;
    }

    .dashboard-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
    }

    .dashboard-header .subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
        margin-bottom: 0.5rem;
    }

    .dashboard-header .time-info {
        font-size: 0.9rem;
        opacity: 0.85;
    }

    /* Pulse Animation */
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .user-status {
        animation: pulse 2s infinite;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border: none;
        border-radius: 12px;
        padding: 2rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: var(--color-light);
        border-radius: 0 0 0 50px;
        opacity: 0.5;
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .stat-card.primary { --color: #6f4e37; --color-light: rgba(111, 78, 55, 0.1); }
    .stat-card.success { --color: #28a745; --color-light: rgba(40, 167, 69, 0.1); }
    .stat-card.info { --color: #17a2b8; --color-light: rgba(23, 162, 184, 0.1); }
    .stat-card.warning { --color: #ffc107; --color-light: rgba(255, 193, 7, 0.1); }

    .stat-card .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        display: inline-block;
    }

    .stat-card .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #999;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .stat-card .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--color);
        margin-bottom: 1rem;
    }

    .stat-card .stat-link {
        color: var(--color);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .stat-card .stat-link:hover {
        gap: 0.75rem;
        color: var(--color);
    }

    .stat-card .stat-link::after {
        content: '→';
    }

    /* Quick Actions Section */
    .quick-actions {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 3rem;
    }

    .quick-actions .section-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 1.5rem;
        border-bottom: 2px solid #dee2e6;
        border-radius: 12px 12px 0 0;
    }

    .quick-actions .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }

    .action-btn {
        padding: 1.2rem;
        border-radius: 10px;
        border: 2px solid transparent;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        min-height: 100px;
        flex-direction: column;
        text-decoration: none;
        color: white;
    }

    .action-btn.primary { background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%); }
    .action-btn.success { background: linear-gradient(135deg, #28a745 0%, #20c997 100%); }
    .action-btn.info { background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%); }
    .action-btn.secondary { background: linear-gradient(135deg, #6c757d 0%, #868e96 100%); }

    .action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        color: white;
    }

    .action-btn .icon {
        font-size: 1.8rem;
    }

    .action-btn .text {
        font-size: 0.9rem;
    }

    /* Recent Orders Section */
    .data-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
    }

    .data-section .section-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 1.5rem;
        border-bottom: 2px solid #dee2e6;
        border-radius: 12px 12px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .data-section .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }

    .data-section .view-all {
        color: #6f4e37;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .data-section table {
        margin-bottom: 0;
    }

    .data-section th {
        background: #f8f9fa;
        border-top: none;
        font-weight: 700;
        color: #2c3e50;
        padding: 1rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-section td {
        padding: 1rem;
        border-color: #dee2e6;
        vertical-align: middle;
    }

    .data-section tbody tr {
        transition: all 0.2s ease;
    }

    .data-section tbody tr:hover {
        background: #f8f9fa;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-pending { background: #fff3cd; color: #856404; }
    .status-processing { background: #cfe2ff; color: #084298; }
    .status-completed { background: #d1e7dd; color: #0f5132; }

    /* Manage Users Button (so cool) */
    .btn-manage-users {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 0.9rem;
        border-radius: 999px;
        color: white;
        font-weight: 800;
        text-decoration: none;
        background: linear-gradient(135deg, #6c3483 0%, #7d3c98 100%);
        box-shadow: 0 8px 22px rgba(124, 77, 161, 0.18);
        transition: transform 0.18s ease, box-shadow 0.18s ease;
        border: none;
    }

    .btn-manage-users .manage-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background: rgba(255,255,255,0.12);
        box-shadow: inset 0 -2px 0 rgba(0,0,0,0.05);
    }

    .btn-manage-users:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(124,77,161,0.22); }

    /* Small rounded action icons in tables */
    .user-action {
        display:inline-flex;
        align-items:center;
        justify-content:center;
        width:34px;
        height:34px;
        border-radius:8px;
        background:#fff;
        border:1px solid #ececec;
        color:#6f4e37;
        text-decoration:none;
        font-size:0.95rem;
        transition: all 0.18s ease;
    }

    .user-action:hover { background: linear-gradient(135deg,#f3e8ff,#efe0ff); color:#5a2b7a; transform: translateY(-2px); box-shadow: 0 6px 18px rgba(111,78,131,0.12); }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header h1 {
            font-size: 2rem;
        }

        .dashboard-header {
            padding: 2rem 1.5rem;
        }

        .stat-card {
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .action-btn {
            min-height: 80px;
        }
    }
</style>
@endsection

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="content">
        <h1>☕ Welcome, {{ Auth::user()->name }}!</h1>
        <p class="subtitle">Manage your coffee business efficiently</p>
        <p class="time-info">Last login: {{ Auth::user()->updated_at->diffForHumans() }}</p>
    </div>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card primary">
            <div class="stat-icon">☕</div>
            <div class="stat-label">Total Products</div>
            <div class="stat-number">{{ \App\Models\Product::count() }}</div>
            <a href="{{ url('/products') }}" class="stat-link">View Details</a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card success">
            <div class="stat-icon">📦</div>
            <div class="stat-label">Total Orders</div>
            <div class="stat-number">{{ \App\Models\Order::count() }}</div>
            <a href="{{ url('/orders') }}" class="stat-link">View Details</a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card info">
            <div class="stat-icon">👥</div>
            <div class="stat-label">Total Customers</div>
            <div class="stat-number">{{ \App\Models\Customer::count() }}</div>
            <a href="{{ url('/customers') }}" class="stat-link">View Details</a>
        </div>
    </div>

    <div class="col-md-6 col-lg-3 mb-3">
        <div class="stat-card warning">
            <div class="stat-icon">💰</div>
            <div class="stat-label">Total Revenue</div>
            <div class="stat-number">${{ number_format(\App\Models\Order::sum('total'), 0) }}</div>
            <small class="text-muted">All time earnings</small>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <div class="section-header">
        <h3 class="section-title">⚡ Quick Actions</h3>
    </div>
    <div class="p-4">
        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ url('/products/create') }}" class="action-btn primary">
                    <span class="icon">➕</span>
                    <span class="text">New Product</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ url('/orders/pos') }}" class="action-btn success">
                    <span class="icon">📦</span>
                    <span class="text">New Order</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ url('/customers/create') }}" class="action-btn info">
                    <span class="icon">👤</span>
                    <span class="text">New Customer</span>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ url('/categories/create') }}" class="action-btn secondary">
                    <span class="icon">📂</span>
                    <span class="text">New Category</span>
                </a>
            </div>
        </div>
        @auth
            @if(Auth::user()->isAdmin())
            <div class="row mt-3">
                <div class="col-md-3">
                    <a href="{{ url('/users') }}" class="action-btn" style="background: linear-gradient(135deg, #6c3483 0%, #7d3c98 100%);">
                        <span class="icon">👨‍💼</span>
                        <span class="text">Manage Users</span>
                    </a>
                </div>
            </div>
            @endif
        @endauth
    </div>
</div>

<!-- Recent Orders -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="data-section">
            <div class="section-header">
                <h3 class="section-title">📦 Recent Orders</h3>
                <a href="{{ url('/orders') }}" class="view-all">View All →</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Order::latest()->take(5)->get() as $order)
                            <tr>
                                <td><strong>#{{ $order->id }}</strong></td>
                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                <td>${{ number_format($order->total, 2) }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($order->status) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No orders yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-lg-4">
        <div class="data-section">
            <div class="section-header">
                <h3 class="section-title">⭐ Top Products</h3>
            </div>
            <div class="p-3">
                @forelse(\App\Models\Product::orderBy('created_at', 'desc')->take(5)->get() as $product)
                    <div>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 10%; height: 30px; md-2 object-fit: cover; border-radius: 8px;">
                        @else
                            <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height: 120px;">
                                <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                    </div>
                    <div style="padding: 1rem 0; border-bottom: 1px solid #dee2e6; display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <h6 style="margin: 0; font-weight: 600; color: #2c3e50;">{{ $product->name }}</h6>
                            <small class="text-muted">{{ $product->category->name ?? 'No category' }}</small>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-weight: 700; color: #6f4e37;">${{ number_format($product->price, 2) }}</div>
                            <small class="text-muted" style="display: block;">Stock: {{ $product->stock }}</small>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted py-4">No products yet</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Users Section (Admin Only) -->
@auth
    @if(Auth::user()->isAdmin())
    <div class="row">
        <div class="col-lg-12">
            <div class="data-section">
                <div class="section-header" style="align-items:center;">
                    <h3 class="section-title">👥 System Users</h3>
                    <a href="{{ url('/users') }}" class="btn-manage-users">
                        <span class="manage-icon"><i class="bi bi-people-fill" style="font-size:0.95rem;"></i></span>
                        <span>Manage Users</span>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="user-no" style="width:60px;text-align:center;font-weight:800;color:#6c3483;">No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\User::latest()->take(8)->get() as $user)
                                <tr>
                                    <td class="user-no" style="text-align:center;font-weight:700;color:#6c3483;">{{ $loop->iteration }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <strong>{{ $user->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span style="display: inline-block; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; 
                                            @if($user->role === 'admin')
                                                background: #d6f5ff; color: #0c5460;
                                            @else
                                                background: #d4edda; color: #155724;
                                            @endif
                                        ">
                                            {{ $user->role === 'admin' ? '👑 Admin' : '👤 User' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span style="display: inline-block; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; 
                                            @if($user->status === 'active')
                                                background: #d1e7dd; color: #0f5132;
                                            @else
                                                background: #f8d7da; color: #842029;
                                            @endif
                                        ">
                                            @if($user->status === 'active')
                                                <span class="user-status" style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background: #28a745; margin-right: 0.35rem; animation: pulse 2s infinite;"></span>
                                                🟢 Active
                                            @else
                                                🔴 Inactive
                                            @endif
                                        </span>
                                    </td>
                                    <td><small>{{ $user->created_at->format('M d, Y') }}</small></td>
                                    <td>
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ route('users.show', $user) }}" class="user-action" title="View">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="user-action" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
@endauth

@endsection
    </body>
    </html>


