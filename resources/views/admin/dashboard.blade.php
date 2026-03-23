@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
            <h2 class="mb-4">Admin Dashboard</h2>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Products</h6>
                            <h3 class="text-primary">{{ App\Models\Product::active()->count() }}</h3>
                            <small class="text-muted">
                                <i class="fas fa-arrow-up text-success"></i>
                                Active Products
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Users</h6>
                            <h3 class="text-primary">{{ App\Models\User::where('role', 'user')->count() }}</h3>
                            <small class="text-muted">
                                <i class="fas fa-users"></i>
                                Customers
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Orders</h6>
                            <h3 class="text-primary">{{ App\Models\Order::count() }}</h3>
                            <small class="text-muted">
                                <i class="fas fa-shopping-cart text-warning"></i>
                                All Orders
                            </small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Revenue</h6>
                            <h3 class="text-success">₱{{ number_format(App\Models\Order::sum('total_amount'), 2) }}</h3>
                            <small class="text-muted">
                                <i class="fas fa-dollar-sign text-success"></i>
                                From Sales
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Actions</h5>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-user-plus"></i> Add User
                    </a>
                    <a href="{{ route('admin.analytics') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-chart-pie"></i> View Analytics
                    </a>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Recent Orders</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Order::latest()->limit(5)->get() as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->fname }} {{ $order->user->lname }}</td>
                                        <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
@endsection
