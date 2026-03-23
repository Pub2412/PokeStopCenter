@extends('layouts.admin')

@section('title', 'Admin Users')

@section('extra-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Users</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add User</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table id="usersTable" class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->lname }}, {{ $user->fname }} {{ $user->middle_initial }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="d-flex gap-2">
                                    @csrf
                                    <select name="role" class="form-select form-select-sm" style="max-width: 120px;">
                                        <option value="user" @selected($user->role === 'user')>User</option>
                                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    </select>
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Save</button>
                                </form>
                            </td>
                            <td>{{ ucfirst($user->status) }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-outline-primary">View</a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-outline-warning" type="submit">Toggle Status</button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
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
        $('#usersTable').DataTable({
            pageLength: 10,
            order: [[0, 'asc']]
        });
    });
</script>
@endsection
