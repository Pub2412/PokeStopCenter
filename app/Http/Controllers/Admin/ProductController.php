<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductPhoto;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display product listing (with soft deletes)
     */
    public function index()
    {
        $products = Product::withTrashed()
            ->with('category', 'photos')
            ->latest()
            ->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show create product form
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store product
     */
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $product = Product::create($validated);

        // Upload photos
        if ($request->hasFile('photos')) {
            $primaryPhoto = true;
            foreach ($request->file('photos') as $file) {
                $path = $file->store('product-images', 'public');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo_path' => $path,
                    'is_primary' => $primaryPhoto,
                ]);
                $primaryPhoto = false;
            }
        }

        return redirect()->route('admin.products.index')->with(['success' => 'Product created successfully!']);
    }

    /**
     * Show product details
     */
    public function show(Product $product)
    {
        $product->load('category', 'photos');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show edit form
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('photos');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update product
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        $product->update($validated);

        // Upload new photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('product-images', 'public');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with(['success' => 'Product updated successfully!']);
    }

    /**
     * Soft delete product
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with(['success' => 'Product deleted successfully!']);
    }

    /**
     * Restore soft deleted product
     */
    public function restore($productId)
    {
        $product = Product::withTrashed()->find($productId);
        $product->restore();
        return back()->with(['success' => 'Product restored successfully!']);
    }

    /**
     * Force delete product
     */
    public function forceDelete($productId)
    {
        $product = Product::withTrashed()->find($productId);
        $product->forceDelete();
        return back()->with(['success' => 'Product permanently deleted!']);
    }

    /**
     * Upload photos to product
     */
    public function uploadPhotos(Request $request, Product $product)
    {
        $validated = $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photos')) {
            $hasPrimary = $product->photos()->where('is_primary', true)->exists();
            foreach ($request->file('photos') as $file) {
                $path = $file->store('product-images', 'public');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo_path' => $path,
                    'is_primary' => !$hasPrimary,
                ]);
                $hasPrimary = true;
            }
        }

        return back()->with(['success' => 'Photos uploaded successfully!']);
    }

    /**
     * Set selected photo as primary
     */
    public function setPrimaryPhoto(Product $product, ProductPhoto $photo)
    {
        if ($photo->product_id != $product->id) {
            abort(403);
        }

        $product->photos()->update(['is_primary' => false]);
        $photo->update(['is_primary' => true]);

        return back()->with(['success' => 'Primary photo updated!']);
    }

    /**
     * Delete photo
     */
    public function deletePhoto(Product $product, ProductPhoto $photo)
    {
        if ($photo->product_id != $product->id) {
            abort(403);
        }

        $wasPrimary = $photo->is_primary;

        // Delete file
        if (Storage::disk('public')->exists($photo->photo_path)) {
            Storage::disk('public')->delete($photo->photo_path);
        }

        $photo->delete();

        // If the deleted image was primary, assign primary to the next available photo.
        if ($wasPrimary) {
            $nextPhoto = $product->photos()->first();
            if ($nextPhoto) {
                $nextPhoto->update(['is_primary' => true]);
            }
        }

        return back()->with(['success' => 'Photo deleted!']);
    }

    /**
     * Import products from Excel
     */
    public function import(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        Excel::import(new ProductsImport, $validated['file']);

        return back()->with(['success' => 'Products imported successfully!']);
    }
}

