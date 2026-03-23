@extends('layouts.admin')

@section('title', 'Admin Products')

@section('extra-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Products</h1>
        <div class="d-flex gap-2">
            <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                @csrf
                <input type="file" name="file" class="form-control form-control-sm" accept=".xlsx,.xls,.csv" required>
                <button class="btn btn-sm btn-outline-primary" type="submit">Import Excel</button>
            </form>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table id="productsTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Deleted</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->is_active ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $product->deleted_at ? 'Yes' : 'No' }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Edit</a>

                                @if($product->deleted_at)
                                    <form method="POST" action="{{ route('admin.products.restore', $product->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-success" type="submit">Restore</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.products.force-delete', $product->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-dark" type="submit">Force Delete</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">There is none</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-body small text-muted">
            DataTable enabled: search, sort, and pagination are available in-table.
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(function () {
        $('#productsTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']]
        });
    });
</script>
@endsection
