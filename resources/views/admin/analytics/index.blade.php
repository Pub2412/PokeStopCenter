@extends('layouts.admin')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="mb-4">📊 Analytics Dashboard</h1>
            
            <!-- Date Range Filter -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.analytics') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ $startDate }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ $endDate }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card" style="border-top: 4px solid #FFCC00;">
                <div class="card-body">
                    <h6 class="text-muted">Total Revenue</h6>
                    <h3 class="text-primary">₱{{ number_format($totalRevenue, 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-top: 4px solid #3B4CCA;">
                <div class="card-body">
                    <h6 class="text-muted">Total Orders</h6>
                    <h3 class="text-info">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-top: 4px solid #00AA00;">
                <div class="card-body">
                    <h6 class="text-muted">Avg Order Value</h6>
                    <h3 class="text-success">₱{{ number_format($avgOrderValue, 2) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card" style="border-top: 4px solid #FF6B6B;">
                <div class="card-body">
                    <h6 class="text-muted">Products</h6>
                    <h3 class="text-danger">{{ $totalProducts }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 1 -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📈 Sales Bar Chart (Selected Date Range)</h5>
                </div>
                <div class="card-body">
                    <canvas id="salesByDateChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📊 Product Sales Contribution (%)</h5>
                </div>
                <div class="card-body">
                    <canvas id="productSalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row 2 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📉 Yearly Sales Data</h5>
                </div>
                <div class="card-body">
                    <canvas id="yearlySalesChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Sales Bar Chart (Date Range)
    const salesByDateCtx = document.getElementById('salesByDateChart').getContext('2d');
    new Chart(salesByDateCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($salesByDateData['labels']) !!},
            datasets: [{
                label: 'Sales Amount (₱)',
                data: {!! json_encode($salesByDateData['data']) !!},
                backgroundColor: 'rgba(59, 76, 202, 0.7)',
                borderColor: '#3B4CCA',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Product Sales Chart (Pie Chart)
    const productCtx = document.getElementById('productSalesChart').getContext('2d');
    const colors = ['#FFCC00', '#3B4CCA', '#FF6B6B', '#00AA00', '#FFA500', '#9C27B0', '#00BCD4', '#8BC34A', '#FF9800', '#E91E63'];
    new Chart(productCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($productSalesData['labels']) !!},
            datasets: [{
                data: {!! json_encode($productSalesData['data']) !!},
                backgroundColor: colors.slice(0, {!! count($productSalesData['labels']) !!}),
                borderColor: '#fff',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + '%';
                        }
                    }
                }
            }
        }
    });

    // Yearly Sales Chart (Bar Chart)
    const yearlyCtx = document.getElementById('yearlySalesChart').getContext('2d');
    new Chart(yearlyCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($yearlySalesData['labels']) !!},
            datasets: [{
                label: 'Yearly Sales Amount (₱)',
                data: {!! json_encode($yearlySalesData['data']) !!},
                backgroundColor: ['#FFCC00', '#3B4CCA', '#FF6B6B', '#00AA00', '#FFA500', '#9C27B0', '#00BCD4', '#8BC34A', '#FF9800', '#E91E63', '#795548', '#9E9E9E'].slice(0, {!! count($yearlySalesData['labels']) !!}),
                borderColor: '#333',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₱' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
