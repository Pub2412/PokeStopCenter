<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Poke Stop Center') - Pokemon Merchandise Store</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #FFCC00;
            --secondary-color: #3B4CCA;
            --danger-color: #FF0000;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
        }
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
        }
        .navbar .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 0.5rem;
        }
        .navbar .nav-link:hover {
            text-decoration: underline;
        }
        .hero {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
            margin-bottom: 40px;
        }
        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 8px;
            overflow: hidden;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .product-image {
            height: 250px;
            object-fit: cover;
            background-color: #e9ecef;
        }
        .badge-primary {
            background-color: var(--primary-color) !important;
            color: var(--secondary-color) !important;
        }
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .btn-primary:hover {
            background-color: #2a36a8;
            border-color: #2a36a8;
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        .admin-sidebar {
            position: sticky;
            top: 0;
            min-height: 100vh;
            background-color: #2c3e50;
        }
        .admin-sidebar .nav-link {
            color: #ecf0f1 !important;
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
        }
        .admin-sidebar .nav-link.active {
            border-left-color: var(--primary-color);
            background-color: rgba(255, 204, 0, 0.1);
        }
        .admin-sidebar .nav-link:hover {
            border-left-color: var(--primary-color);
            background-color: rgba(255, 204, 0, 0.05);
        }
        .alert {
            border: none;
            border-radius: 8px;
        }
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    @yield('extra-styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('shop.index') }}">
                <i class="fas fa-shopping-bag"></i> PokeStop Center
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                        </li>
                    @elseif(auth()->check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i> Cart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.show') }}">My Profile</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        @if(auth()->check())
                            <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="nav-link btn btn-link" type="submit">Logout</button>
                            </form>
                        @else
                            <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Messages -->
    <div class="container mt-3">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error:</strong>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>About PokeStop Center</h5>
                    <p>Your one-stop shop for authentic Pokemon merchandise, trading cards, and collectibles.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('shop.index') }}" class="text-white-50">Shop</a></li>
                        <li><a href="#" class="text-white-50">About Us</a></li>
                        <li><a href="#" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Follow Us</h5>
                    <p>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white-50 me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-instagram"></i></a>
                    </p>
                </div>
            </div>
            <hr>
            <p class="text-center text-white-50 mb-0">&copy; 2026 PokeStop Center. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('extra-scripts')
</body>
</html>
