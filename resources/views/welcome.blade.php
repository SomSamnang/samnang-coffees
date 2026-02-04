<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Samnang Coffee - Premium Coffee Management</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                background-color: #f8f9fa;
            }

            /* Split Layout - Slider Left & Header Right */
            .carousel-container {
                height: 500px;
                overflow: hidden;
                border-radius: 12px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            }

            .carousel {
                height: 100%;
            }

            .carousel-item {
                height: 100%;
                background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }

            .carousel-item::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.2);
                z-index: 1;
            }

            .carousel-item-content {
                position: relative;
                z-index: 2;
                text-align: center;
                color: white;
                animation: fadeInUp 0.8s ease;
                padding: 40px;
            }

            .carousel-item-content h2 {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 1rem;
                text-shadow: 2px 2px 8px rgba(0,0,0,0.3);
            }

            .carousel-item-content p {
                font-size: 1.1rem;
                text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
            }

            .carousel-control-prev,
            .carousel-control-next {
                background: rgba(0,0,0,0.3);
                border-radius: 50%;
                width: 45px;
                height: 45px;
                top: 50%;
                transform: translateY(-50%);
            }

            .carousel-control-prev {
                left: 1.5rem;
            }

            .carousel-control-next {
                right: 1.5rem;
            }

            .carousel-control-prev:hover,
            .carousel-control-next:hover {
                background: rgba(0,0,0,0.6);
            }

            .carousel-indicators {
                bottom: 2rem;
            }

            .carousel-indicators [data-bs-target] {
                background-color: rgba(255,255,255,0.5);
                width: 12px;
                height: 12px;
                border-radius: 50%;
                margin: 0 8px;
                transition: all 0.3s ease;
            }

            .carousel-indicators .active {
                background-color: #fff;
                width: 30px;
                border-radius: 6px;
            }

            /* Hero Content Right */
            .hero-content {
                animation: fadeInRight 0.8s ease;
            }

            .text-gradient {
                background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .display-4 {
                font-weight: 700;
                line-height: 1.2;
            }

            .lead {
                font-size: 1.2rem;
            }

            .features-list {
                margin: 2rem 0;
            }

            .feature-item {
                display: flex;
                gap: 15px;
                align-items: flex-start;
                margin-bottom: 1.5rem;
            }

            .feature-icon {
                font-size: 2.2rem;
                min-width: 55px;
                text-align: center;
            }

            .feature-text h5 {
                color: #333;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .feature-text p {
                margin: 0;
                font-size: 0.95rem;
            }

            .btn-primary {
                background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
                border: none;
                transition: all 0.3s ease;
                font-weight: 600;
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(111, 78, 55, 0.3);
                background: linear-gradient(135deg, #5c4530 0%, #7a5f3a 100%);
            }

            .btn-outline-primary {
                color: #6f4e37;
                border-color: #6f4e37;
                transition: all 0.3s ease;
                font-weight: 600;
            }

            .btn-outline-primary:hover {
                background: #6f4e37;
                border-color: #6f4e37;
                transform: translateY(-3px);
            }

            .trust-badge {
                text-align: center;
                flex: 1;
            }

            .trust-badge h6 {
                color: #6f4e37;
                font-weight: 700;
                font-size: 1.5rem;
                margin: 0;
            }

            .trust-badge small {
                display: block;
                font-size: 0.85rem;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInRight {
                from {
                    opacity: 0;
                    transform: translateX(30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .navbar {
                background: white;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            .navbar-brand {
                font-weight: 700;
                color: #6f4e37 !important;
                font-size: 1.5rem;
            }

            footer {
                background: linear-gradient(135deg, #6f4e37 0%, #8b6f47 100%);
                color: white;
                margin-top: 4rem;
                padding: 3rem 0;
            }

            @media (max-width: 992px) {
                .carousel-container {
                    height: 400px;
                }

                .carousel-item-content h2 {
                    font-size: 1.7rem;
                }

                .hero-content {
                    margin-top: 2rem;
                }
            }

            @media (max-width: 768px) {
                .carousel-item-content h2 {
                    font-size: 1.5rem;
                }

                .carousel-item-content p {
                    font-size: 1rem;
                }

                .carousel-container {
                    height: 350px;
                }

                .display-4 {
                    font-size: 2rem !important;
                }

                .d-flex.gap-3 {
                    flex-direction: column !important;
                }

                .btn-lg {
                    width: 100%;
                }

                .feature-item {
                    margin-bottom: 1rem;
                }

                .feature-icon {
                    font-size: 1.8rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container-fluid px-4">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <span style="font-size: 2rem;">☕</span> Samnang Coffee
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="nav-link btn btn-link">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Hero Section with Slider on Left -->
        <div class="container-fluid mt-5 mb-5">
            <div class="row g-4 align-items-center">
                <!-- LEFT: Carousel Slider -->
                <div class="col-lg-6">
                    <div class="carousel-container">
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                            <!-- Carousel Indicators -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
                            </div>

                            <!-- Carousel Items -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="carousel-item-content">
                                        <h2>☕ Premium Coffee Beans</h2>
                                        <p>High quality arabica and robusta varieties</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="carousel-item-content">
                                        <h2>🌾 Fresh Roasted</h2>
                                        <p>Daily roasting for maximum freshness</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="carousel-item-content">
                                        <h2>🌍 Ethically Sourced</h2>
                                        <p>Direct trade with coffee farmers</p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <div class="carousel-item-content">
                                        <h2>✨ Exceptional Quality</h2>
                                        <p>Award-winning coffee blends</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Carousel Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Header Content -->
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1 class="display-4 fw-bold mb-3">
                            ☕ Welcome to<br>
                            <span class="text-gradient">Samnang Coffee</span>
                        </h1>
                        
                        <p class="lead text-muted mb-4">
                            Premium Coffee Management System designed to help your coffee business thrive
                        </p>

                        <!-- Features List -->
                        <div class="features-list mb-5">
                            <div class="feature-item mb-3">
                                <span class="feature-icon">☕</span>
                                <div class="feature-text">
                                    <h5>Smart Inventory</h5>
                                    <p class="text-muted small">Manage products and stock levels effortlessly</p>
                                </div>
                            </div>
                            <div class="feature-item mb-3">
                                <span class="feature-icon">📊</span>
                                <div class="feature-text">
                                    <h5>Real-time Dashboard</h5>
                                    <p class="text-muted small">Track sales and analytics at a glance</p>
                                </div>
                            </div>
                            <div class="feature-item mb-3">
                                <span class="feature-icon">👥</span>
                                <div class="feature-text">
                                    <h5>Customer Management</h5>
                                    <p class="text-muted small">Organize and maintain customer relationships</p>
                                </div>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">📦</span>
                                <div class="feature-text">
                                    <h5>Order Tracking</h5>
                                    <p class="text-muted small">Seamless order management system</p>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="d-flex gap-3">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg px-5">
                                    Go to Dashboard →
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">
                                    Login Now
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-5">
                                    Create Account
                                </a>
                            @endauth
                        </div>

                        <!-- Trust Badges -->
                        <div class="mt-5 pt-4 border-top">
                            <p class="text-muted small mb-3">Trusted by coffee businesses worldwide</p>
                            <div class="d-flex gap-4">
                                <div class="trust-badge">
                                    <h6 class="mb-1">100%</h6>
                                    <small class="text-muted">Secure</small>
                                </div>
                                <div class="trust-badge">
                                    <h6 class="mb-1">24/7</h6>
                                    <small class="text-muted">Available</small>
                                </div>
                                <div class="trust-badge">
                                    <h6 class="mb-1">∞</h6>
                                    <small class="text-muted">Scalable</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center py-5">
            <div class="container">
                <p class="mb-0">&copy; 2026 Samnang Coffee Management System. All rights reserved.</p>
                <p class="text-white-50 small mt-2">Designed to help coffee businesses thrive</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Auto-advance carousel every 6 seconds
            const carousel = document.getElementById('heroCarousel');
            const bsCarousel = new bootstrap.Carousel(carousel, {
                interval: 6000,
                wrap: true
            });
        </script>
    </body>
</html>
