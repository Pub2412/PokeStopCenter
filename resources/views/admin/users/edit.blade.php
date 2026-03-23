@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="container py-4">
    <h1 class="h4 mb-3">Edit User</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="lname" class="form-control" value="{{ old('lname', $user->lname) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">First Name</label>
                        <input type="text" name="fname" class="form-control" value="{{ old('fname', $user->fname) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Middle Initial</label>
                        <input type="text" name="middle_initial" class="form-control" maxlength="1" value="{{ old('middle_initial', $user->middle_initial) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="profile_photo" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button class="btn btn-primary" type="submit">Update User</button>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-outline-secondary">View</a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
