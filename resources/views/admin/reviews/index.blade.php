@extends('layouts.admin')

@section('title', 'Admin Reviews')

@section('extra-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Reviews</h1>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table id="reviewsTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>User</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{ $review->id }}</td>
                            <td>{{ $review->product->name ?? 'N/A' }}</td>
                            <td>{{ $review->user->fname ?? 'N/A' }} {{ $review->user->lname ?? '' }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>{{ \Illuminate\Support\Str::limit($review->comment, 80) }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.reviews.admin-delete', $review) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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
        $('#reviewsTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']],
            language: {
                emptyTable: 'There is none'
            }
        });
    });
</script>
@endsection
