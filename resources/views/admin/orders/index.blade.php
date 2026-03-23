@extends('layouts.admin')

@section('title', 'Admin Orders')

@section('extra-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Orders</h1>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table id="ordersTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->fname ?? 'N/A' }} {{ $order->user->lname ?? '' }}</td>
                            <td>₱{{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ optional($order->created_at)->format('M d, Y') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="d-flex gap-2">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" style="max-width: 150px;">
                                        <option value="pending" @selected($order->status === 'pending')>Pending</option>
                                        <option value="completed" @selected($order->status === 'completed')>Completed</option>
                                        <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">There is none</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($orders, 'links'))
            <div class="card-body">{{ $orders->links() }}</div>
        @endif
    </div>
</div>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function () {
        $('#ordersTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']]
        });
    });
</script>
@endsection
