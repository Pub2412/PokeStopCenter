<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Display all products
     */
    public function index()
    {
        $products = Product::with(['category', 'photos', 'reviews'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);
        
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * Show single product
     */
    public function show(Product $product)
    {
        $product->load(['category', 'photos', 'reviews.user']);

        if (!$product->is_active) {
            abort(404, 'Product not found');
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->latest()
            ->limit(4)
            ->get();

        $userHasPurchased = false;
        if (Auth::check()) {
            /** @var \App\Models\User $currentUser */
            $currentUser = Auth::user();
            $userHasPurchased = $currentUser->orders()
                ->whereHas('items', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->exists();
        }

        $existingUserReview = null;
        if (Auth::check()) {
            $existingUserReview = $product->reviews->firstWhere('user_id', Auth::id());
        }

        return view('shop.product-detail', compact('product', 'relatedProducts', 'userHasPurchased', 'existingUserReview'));
    }

    /**
     * Search products (MP8)
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $mode = $request->get('mode', 'like');
        
        if (strlen($query) < 2) {
            return redirect()->route('shop.index')->withErrors('Search query too short');
        }

        if ($mode === 'model') {
            // Model scope search (MP8 - 10pts requirement)
            $products = Product::with(['category', 'photos'])
                ->active()
                ->keywordSearch($query)
                ->latest()
                ->paginate(12)
                ->appends(['q' => $query, 'mode' => $mode]);
        } elseif ($mode === 'scout') {
            // Laravel Scout search with pagination (MP8 - 15pts requirement)
            $products = Product::search($query)
                ->query(function ($builder) {
                    $builder->with(['category', 'photos'])->where('is_active', true)->latest();
                })
                ->paginate(12)
                ->appends(['q' => $query, 'mode' => $mode]);
        } else {
            // LIKE query search (MP8 - 8pts requirement)
            $products = Product::with(['category', 'photos'])
                ->active()
                ->keywordSearch($query)
                ->latest()
                ->paginate(12)
                ->appends(['q' => $query, 'mode' => $mode]);
        }

        $categories = Category::all();

        return view('shop.index', compact('products', 'categories', 'query', 'mode'));
    }

    /**
     * Filter products (MP6)
     */
    public function filter(Request $request)
    {
        $query = Product::with(['category', 'photos'])
            ->where('is_active', true);

        // Filter by category
        if ($request->has('category') && $request->get('category')) {
            $query->where('category_id', $request->get('category'));
        }

        // Filter by price range (MP6 - 10pts requirement)
        if ($request->has('price_min') && $request->get('price_min')) {
            $query->where('price', '>=', $request->get('price_min'));
        }

        if ($request->has('price_max') && $request->get('price_max')) {
            $query->where('price', '<=', $request->get('price_max'));
        }

        // Filter by brand (MP6 - 15pts requirement)
        if ($request->has('brand') && $request->get('brand')) {
            $query->where('brand', $request->get('brand'));
        }

        // Filter by type (MP6 - 15pts requirement)
        if ($request->has('type') && $request->get('type')) {
            $query->where('type', $request->get('type'));
        }

        $products = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }
}

