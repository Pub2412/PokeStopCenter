@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="container py-4">
    <h1 class="h4 mb-3">Edit Product</h1>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" value="{{ old('type', $product->type) }}" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Add New Photos</label>
                        <input type="file" name="photos[]" class="form-control" accept="image/*" multiple>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" @checked(old('is_active', $product->is_active))>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">Existing Photos</div>
        <div class="card-body">
            <div class="row g-3">
                @forelse($product->photos as $photo)
                    <div class="col-md-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" class="card-img-top" alt="Photo">
                            <div class="card-body p-2">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small>{{ $photo->is_primary ? 'Primary' : 'Secondary' }}</small>
                                </div>
                                <div class="d-flex gap-2">
                                    @if(!$photo->is_primary)
                                        <form method="POST" action="{{ route('admin.products.photos.primary', [$product, $photo]) }}">
                                            @csrf
                                            <button class="btn btn-sm btn-outline-primary" type="submit">Set Primary</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.products.photos.delete', [$product, $photo]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="mb-0">There is none</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
