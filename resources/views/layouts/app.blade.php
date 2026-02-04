<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Samnang Coffee')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS for Sidebar Layout -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-bottom: 3px solid #d4a574;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 2rem;
        }

        .header-brand {
            font-weight: 700;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white !important;
            text-decoration: none;
        }

        .header-brand:hover {
            opacity: 0.9;
        }

        .header-title {
            flex: 1;
            margin-left: 2rem;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-dropdown {
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            font-weight: 600;
        }

        .user-profile:hover {
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d4a574 0%, #ffd700 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #333;
            font-size: 0.9rem;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .user-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 2px solid #d4a574;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            min-width: 240px;
            z-index: 1000;
            margin-top: 0.75rem;
            overflow: hidden;
        }

        .user-dropdown-menu.show {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .user-dropdown-header {
            background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #d4a574;
        }

        .user-dropdown-header .user-name {
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .user-dropdown-header .user-role {
            font-size: 0.8rem;
            opacity: 0.9;
            margin-top: 0.25rem;
        }

        .user-dropdown-menu a,
        .user-dropdown-menu button {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.75rem 1.5rem;
            color: #333;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.95rem;
        }

        .user-dropdown-menu a:hover,
        .user-dropdown-menu button:hover {
            background: #f0f0f0;
            color: #6f4e37;
            padding-left: 2rem;
        }

        .user-dropdown-menu a i,
        .user-dropdown-menu button i {
            width: 18px;
            font-size: 1rem;
        }

        .user-dropdown-menu hr {
            margin: 0.5rem 0;
            border: none;
            border-top: 1px solid #e0e0e0;
        }

        .user-dropdown-menu .logout-btn {
            color: #dc3545;
        }

        .user-dropdown-menu .logout-btn:hover {
            background: #ffe0e0;
            color: #dc3545;
        }

        /* Main Container with Sidebar */
        .main-container {
            display: flex;
            flex: 1;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
            color: white;
            padding: 2rem 0;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
            position: fixed;
            height: calc(100vh - 70px);
            overflow-y: auto;
            top: 70px;
            left: 0;
            z-index: 99;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin: 0.5rem 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background: rgba(111, 78, 55, 0.3);
            color: white;
            border-left-color: #d4a574;
            padding-left: 2rem;
            box-shadow: inset -3px 0 0 #d4a574;
        }

        .sidebar-menu a.active {
            background: linear-gradient(90deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            border-left-color: #ffd700;
            box-shadow: inset -3px 0 0 #ffd700;
        }

        .sidebar-menu i {
            font-size: 1.2rem;
            width: 25px;
            text-align: center;
        }

        .sidebar-section {
            margin: 1.5rem 0;
            padding-top: 1rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-section:first-child {
            border-top: none;
        }

        .sidebar-label {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
        }

        /* User Count Badge */
        .user-count-badge {
            background: linear-gradient(135deg, #ff6b6b 0%, #ff8787 100%);
            color: white;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            margin-left: 1rem;
        }

        /* Recent Users Widget */
        .recent-users-widget {
            margin-top: 2rem;
            padding: 1rem 1.5rem;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            margin-left: 1rem;
            margin-right: 1rem;
        }

        .recent-users-widget .widget-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .user-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-size: 0.85rem;
        }

        .user-item:last-child {
            border-bottom: none;
        }

        .user-item-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #d4a574 0%, #ffd700 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #333;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .user-item-info {
            flex: 1;
            min-width: 0;
        }

        .user-item-name {
            color: white;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-item-role {
            color: rgba(255,255,255,0.6);
            font-size: 0.75rem;
        }

        /* User Status Indicator */
        .user-status {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #4caf50;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Content Area */
        .content-area {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
            min-height: calc(100vh - 70px);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #dee2e6;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #6f4e37;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #8b6f47;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                top: 0;
                box-shadow: none;
                border-bottom: 2px solid #dee2e6;
                padding: 1rem 0;
            }

            .sidebar.collapse {
                display: none;
            }

            .sidebar.show {
                display: block;
            }

            .content-area {
                margin-left: 0;
                padding: 1rem;
                min-height: auto;
            }

            .header-title {
                display: none;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .sidebar-menu a {
                padding: 0.75rem 1.5rem;
            }
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: 2rem;
            border-top: 3px solid #d4a574;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <a href="{{ url('/') }}" class="header-brand">
                <span style="font-size: 2rem;">☕</span>
                <span>Samnang Coffee</span>
            </a>

            <div class="header-title">
                Coffee Management System
            </div>

            @auth
                <div class="header-user">
               
                    <div class="user-dropdown">
                        <div class="user-profile" onclick="toggleUserMenu()">
                            <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                            <div>
                                <div style="font-size: 0.95rem; font-weight: 600;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 0.8rem; opacity: 0.9;">
                                    @if(Auth::user()->isAdmin())
                                         Admin
                                    @else
                                        User
                                    @endif
                                </div>
                            </div>
                            <i class="bi bi-chevron-down" style="font-size: 0.75rem;"></i>
                        </div>
                        <div class="user-dropdown-menu" id="userMenu">
                            <div class="user-dropdown-header">
                                    
                                <div class="user-role">
                                    @if(Auth::user()->isAdmin())
                                        Administrator
                                    @else
                                     Regular User
                                    @endif
                                </div>
                                <div style="font-size: 0.75rem; margin-top: 0.5rem; opacity: 0.8;">
                                    Joined: {{ Auth::user()->created_at->format('M d, Y') }}
                                </div>
                            </div>
                            <a href="#" onclick="alert('Profile feature coming soon!')">
                                <i class="bi bi-person"></i> My Profile
                            </a>
                            <a href="#" onclick="alert('Settings feature coming soon!')">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                            @if(Auth::user()->isAdmin())
                                <hr>
                                <a href="{{ url('/users') }}">
                                    <i class="bi bi-person-gear"></i> Manage Users
                                </a>
                                <a href="#" onclick="alert('Admin panel coming soon!')">
                                    <i class="bi bi-shield-lock"></i> Admin Panel
                                </a>
                                <a href="#" onclick="alert('System logs coming soon!')">
                                    <i class="bi bi-file-earmark-text"></i> System Logs
                                </a>
                            @endif
                            <hr>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>
    </div>

    <!-- Main Container with Sidebar -->
    <div class="main-container">
        <!-- Sidebar -->
        @auth
            <aside class="sidebar" id="sidebar">
                <ul class="sidebar-menu">
                    <li class="sidebar-label">Main Menu</li>
                    <li>
                        <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-label" style="margin-top: 1.5rem;">Business</li>
                    <li>
                        <a href="{{ url('/products') }}" class="nav-link {{ request()->is('products*') ? 'active' : '' }}">
                            <i class="bi bi-cup-hot"></i>
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/categories') }}" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                            <i class="bi bi-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/orders') }}" class="nav-link {{ request()->is('orders*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/orders/kds') }}" class="nav-link {{ request()->is('orders/kds') ? 'active' : '' }}">
                            <i class="bi bi-tv-fill"></i>
                            <span>KDS</span>
                        </a>
                    </li>
            
                    <li>
                        <a href="{{ url('/customers') }}" class="nav-link {{ request()->is('customers*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            <span>Customers</span>
                        </a>
                    </li>
                 <li class="sidebar-label" style="margin-top: 1.5rem;">System</li>
                    <li>
                        <a href="{{ url('/settings') }}" class="nav-link {{ request()->is('settings') ? 'active' : '' }}">
                            <i class="bi bi-gear-fill"></i>
                            <span>Settings QR Bank</span>
                        </a>
                    </li>
                    @if(Auth::user()->isAdmin())
                        <li class="sidebar-label" style="margin-top: 1.5rem;">Administration</li>
                        <li>
                            <a href="{{ url('/users') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                <i class="bi bi-person-gear"></i>
                                <span>User Management</span>
                            </a>
                        </li>

                       
                    @endif
                </ul>
            </aside>
        @endauth

        <!-- Content Area -->
        <div class="content-area">
            <!-- Flash Messages -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-exclamation-circle"></i> Errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 Samnang Coffee Management System. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle user dropdown menu
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const userDropdown = document.querySelector('.user-dropdown');
            const menu = document.getElementById('userMenu');
            
            if (!userDropdown.contains(e.target) && menu) {
                menu.classList.remove('show');
            }
        });

        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
