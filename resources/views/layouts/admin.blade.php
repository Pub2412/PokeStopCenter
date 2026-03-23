<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Poke Stop Center</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #e0b946;
            --secondary-color: #0c243d;
            --danger-color: #FF0000;
            --surface-color: #ffffff;
            --page-bg: #f3f5f8;
        }
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(160deg, #ead07b 0%, #d0a944 55%, #b48c30 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(135deg, #f4d468 0%, #e0b946 42%, #c79a2f 100%);
            box-shadow: 0 6px 16px rgba(0,0,0,0.14);
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.35rem;
            color: #1a1a1a !important;
            font-family: 'Russo One', sans-serif;
        }
        .navbar .nav-link {
            color: #1a1a1a !important;
            font-weight: 700;
            margin: 0 0.5rem;
        }
        .navbar .nav-link:hover {
            text-decoration: none;
            opacity: 0.86;
        }
        .admin-container {
            display: flex;
            min-height: calc(100vh - 74px);
            gap: 16px;
            padding: 14px 16px 18px;
        }
        .admin-sidebar {
            width: 250px;
            background: linear-gradient(180deg, #0c243d 0%, #0f2f4d 100%);
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            overflow-y: auto;
            padding-bottom: 8px;
        }
        .admin-sidebar h5 {
            color: white;
            padding: 1.2rem 1.2rem 1rem;
            margin: 0;
            border-bottom: 1px solid rgba(224, 185, 70, 0.25);
            font-family: 'Russo One', sans-serif;
            letter-spacing: 0.3px;
        }
        .admin-sidebar .nav {
            flex-direction: column;
            padding-top: 6px;
        }
        .admin-sidebar .nav-link {
            color: #eef4fb !important;
            padding: 0.7rem 1.2rem;
            margin: 2px 8px;
            border-left: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .admin-sidebar .nav-link:hover {
            background-color: rgba(224, 185, 70, 0.18);
        }
        .admin-sidebar .nav-link.active {
            background-color: rgba(224, 185, 70, 0.28);
            color: #fff6d9 !important;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08);
        }
        .admin-sidebar .nav-link i {
            width: 20px;
            margin-right: 0.5rem;
        }
        .admin-content {
            flex: 1;
            padding: 1.4rem;
            background: var(--surface-color);
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.17);
            overflow-y: auto;
        }
        .alert {
            border: none;
            border-radius: 12px;
        }
        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            border-radius: 999px;
            font-weight: 700;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .btn-primary:hover {
            background-color: #12395f;
            border-color: #12395f;
        }

        .admin-content .card,
        .admin-content .table,
        .admin-content .form-control,
        .admin-content .form-select {
            border-radius: 12px;
        }

        .admin-footer {
            text-align: center;
            color: #e9eef5;
            font-size: 13px;
            margin-top: 14px;
            margin-bottom: 2px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .admin-container {
                padding: 10px;
            }
            .admin-sidebar {
                width: 100%;
                position: absolute;
                left: -100%;
                top: 74px;
                height: 100%;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            .admin-sidebar.show {
                left: 0;
            }
            .admin-content {
                width: 100%;
            }
        }
    </style>
    @yield('extra-styles')
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <div class="navbar-brand mb-0">
                <i class="fas fa-store"></i> PokeStop Center
                <span style="color: #d62828;">Admin</span>
                <span style="color: #a4161a;">Panel</span>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('auth.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Admin Container -->
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="admin-sidebar">
            <h5>Admin Menu</h5>
            <nav class="nav">
                <a class="nav-link @if(request()->routeIs('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
                <a class="nav-link @if(request()->routeIs('admin.products.*')) active @endif" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-box"></i> Products
                </a>
                <a class="nav-link @if(request()->routeIs('admin.users.*')) active @endif" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i> Users
                </a>
                <a class="nav-link @if(request()->routeIs('admin.orders.*')) active @endif" href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
                <a class="nav-link @if(request()->routeIs('admin.reviews.*')) active @endif" href="{{ route('admin.reviews.index') }}">
                    <i class="fas fa-star"></i> Reviews
                </a>
                <a class="nav-link @if(request()->routeIs('admin.analytics')) active @endif" href="{{ route('admin.analytics') }}">
                    <i class="fas fa-chart-pie"></i> Analytics
                </a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="admin-content">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Errors!</h4>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <p class="admin-footer">© 2026 PokeStop Center Management</p>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    @yield('extra-scripts')
</body>
</html>
