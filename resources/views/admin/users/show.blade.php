@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">User Details</h1>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit</a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p><strong>Name:</strong> {{ $user->lname }}, {{ $user->fname }} {{ $user->middle_initial }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                    <p class="mb-0"><strong>Email Verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}</p>
                </div>
                <div class="col-md-4">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" class="img-fluid rounded" alt="Profile photo">
                    @else
                        <div class="border rounded p-4 text-center">There is none</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Orders</div>
                <div class="card-body">
                    @forelse($user->orders as $order)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>#{{ $order->id }}</span>
                            <span>₱{{ number_format($order->total_amount, 2) }}</span>
                            <span>{{ ucfirst($order->status) }}</span>
                        </div>
                    @empty
                        <p class="mb-0">There is none</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">Reviews</div>
                <div class="card-body">
                    @forelse($user->reviews as $review)
                        <div class="border-bottom py-2">
                            <strong>{{ $review->product->name ?? 'Product' }}</strong>
                            <div>Rating: {{ $review->rating }}/5</div>
                            <small>{{ \Illuminate\Support\Str::limit($review->comment, 90) }}</small>
                        </div>
                    @empty
                        <p class="mb-0">There is none</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary mt-3">Back to list</a>
</div>
@endsection
