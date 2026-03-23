@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h4 mb-0">Product Details</h1>
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary">Edit</a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <p><strong>Name:</strong> {{ $product->name }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                    <p><strong>Price:</strong> ₱{{ number_format($product->price, 2) }}</p>
                    <p><strong>Stock:</strong> {{ $product->stock }}</p>
                    <p><strong>Brand:</strong> {{ $product->brand }}</p>
                    <p><strong>Type:</strong> {{ $product->type }}</p>
                    <p><strong>Status:</strong> {{ $product->is_active ? 'Active' : 'Inactive' }}</p>
                    <p class="mb-0"><strong>Description:</strong><br>{{ $product->description }}</p>
                </div>
                <div class="col-md-4">
                    @if($product->photos->first())
                        <img src="{{ asset('storage/' . $product->photos->first()->photo_path) }}" class="img-fluid rounded" alt="Primary photo">
                    @else
                        <div class="border rounded p-4 text-center">There is none</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back to list</a>
</div>
@endsection
