@extends('layouts.app')

@section('title', 'Shop')

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Russo+One&display=swap" rel="stylesheet">
<style>
    body > nav.navbar,
    body > footer.mt-5,
    body > .container.mt-3 {
        display: none;
    }

    body {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(160deg, #fff7cc 0%, #ffe27f 50%, #f4c74d 100%);
        min-height: 100vh;
        margin: 0;
    }

    .shop-wrap,
    .shop-wrap * {
        box-sizing: border-box;
    }

    .shop-wrap a {
        text-decoration: none;
        color: inherit;
    }

    .safe-area {
        width: 100%;
        max-width: 1120px;
        margin: 0 auto;
        padding-left: 28px;
        padding-right: 28px;
    }

    .shop-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(to bottom, #f6cf57 60%, rgba(246, 207, 87, 0.8) 80%, rgba(246, 207, 87, 0) 100%);
        padding-bottom: 20px;
    }

    .shop-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        padding-top: 16px;
        padding-bottom: 14px;
    }

    .shop-header-left,
    .shop-header-right {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .shop-header-left {
        justify-content: flex-start;
    }

    .shop-header-right {
        justify-content: flex-end;
        gap: 10px;
    }

    .shop-header-center {
        flex: 0 1 auto;
        width: 100%;
        max-width: 540px;
    }

    .shop-logo img {
        height: 52px;
        width: auto;
        display: block;
    }

    .shop-search {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 50px;
        padding: 6px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        gap: 8px;
    }

    .shop-search input,
    .shop-search select {
        border: none;
        outline: none;
        background: transparent;
        font-size: 14px;
    }

    .shop-search input {
        flex: 1;
        min-width: 140px;
        padding: 0 4px 0 10px;
    }

    .shop-search select {
        background: #f3f3f3;
        border-radius: 30px;
        padding: 6px 10px;
    }

    .shop-search-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #f0f0f0;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .shop-pill {
        background: linear-gradient(180deg, #fdf6d8 0%, #e8d88c 100%);
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .shop-icon-pill {
        position: relative;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(180deg, #fdf6d8 0%, #e8d88c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .shop-icon-pill svg {
        width: 22px;
        height: 22px;
        fill: #1a1a1a;
    }

    .shop-cart-count {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 20px;
        height: 20px;
        border-radius: 999px;
        background: #c21807;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 5px;
        border: 2px solid #f6cf57;
    }

    .shop-body {
        padding: 16px 0 60px;
    }

    .shop-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 22px;
    }

    .filter-panel {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        padding: 18px;
        align-self: start;
        position: sticky;
        top: 108px;
    }

    .filter-panel h3 {
        font-family: 'Russo One', sans-serif;
        font-size: 24px;
        margin-bottom: 10px;
    }

    .filter-group {
        margin-bottom: 12px;
    }

    .filter-group label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
    }

    .filter-input {
        width: 100%;
        border: 1px solid #d8d8d8;
        border-radius: 10px;
        padding: 8px 10px;
        font-size: 13px;
    }

    .filter-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 8px;
    }

    .btn-filter-primary,
    .btn-filter-clear {
        border-radius: 999px;
        font-weight: 700;
        font-size: 13px;
        text-align: center;
        padding: 9px 10px;
        border: none;
    }

    .btn-filter-primary {
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        color: #1a1a1a;
    }

    .btn-filter-clear {
        background: #f3f3f3;
        color: #333;
    }

    .products-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        gap: 10px;
    }

    .products-title {
        font-family: 'Russo One', sans-serif;
        font-size: clamp(22px, 3vw, 34px);
        margin: 0;
        color: #1d1d1d;
    }

    .items-badge {
        background: #0c243d;
        color: #fff;
        border-radius: 999px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 700;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .product-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        padding: 14px;
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }

    .product-image-wrap {
        width: 100%;
        aspect-ratio: 4 / 3;
        border-radius: 14px;
        overflow: hidden;
        background: #ebebeb;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-card-body {
        padding: 12px 6px 6px;
        flex: 1;
    }

    .product-name {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 2px;
    }

    .product-cat {
        font-size: 12px;
        color: #666;
        margin-bottom: 6px;
    }

    .product-desc {
        font-size: 13px;
        color: #444;
        margin-bottom: 8px;
    }

    .product-price {
        display: inline-block;
        background: #0c243d;
        color: #fff;
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 13px;
        font-weight: 700;
    }

    .product-stock {
        display: inline-block;
        margin-left: 6px;
        border-radius: 999px;
        padding: 5px 10px;
        font-size: 12px;
        font-weight: 700;
    }

    .product-stock.in {
        background: #d4f7df;
        color: #12743a;
    }

    .product-stock.out {
        background: #ffe0e0;
        color: #a22626;
    }

    .product-rating {
        margin-top: 8px;
        font-size: 12px;
        color: #666;
    }

    .product-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        padding: 8px 6px 4px;
    }

    .view-btn {
        flex: 1;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 700;
        text-align: center;
    }

    .empty-state {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        padding: 26px;
        text-align: center;
    }

    .shop-pagination {
        margin-top: 24px;
    }

    .shop-footer {
        background: #0c243d;
        color: #fff;
        padding: 26px 0;
    }

    .shop-footer-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .shop-footer small {
        color: #dbe5ef;
    }

    .shop-footer a {
        color: #fff;
        font-weight: 600;
    }

    .floating-top-btn {
        position: fixed;
        right: 20px;
        bottom: 24px;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        border: none;
        background: #0C243D;
        color: #fff;
        font-size: 22px;
        line-height: 1;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.35);
        cursor: pointer;
        opacity: 0;
        transform: translateY(12px);
        pointer-events: none;
        transition: opacity 0.2s ease, transform 0.2s ease;
        z-index: 1200;
    }

    .floating-top-btn.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }

    .floating-top-btn:hover {
        filter: brightness(1.08);
    }

    @media (max-width: 1040px) {
        .shop-grid {
            grid-template-columns: 1fr;
        }

        .filter-panel {
            position: static;
        }

        .product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 860px) {
        .shop-header-top {
            flex-wrap: wrap;
        }

        .shop-header-center {
            order: 3;
            max-width: 100%;
            flex: 1 1 100%;
        }
    }

    @media (max-width: 640px) {
        .product-grid {
            grid-template-columns: 1fr;
        }

        .shop-footer-inner {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="shop-wrap" id="top">
    <header class="shop-header">
        <div class="safe-area shop-header-top">
            <div class="shop-header-left">
                <div class="shop-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center">
                    </a>
                </div>
            </div>

            <div class="shop-header-center">
                <form action="{{ route('shop.search') }}" method="GET" class="shop-search" role="search">
                    <input type="text" name="q" placeholder="Search products..." value="{{ request('q') }}">
                    <select name="mode">
                        <option value="like" {{ request('mode', 'like') === 'like' ? 'selected' : '' }}>LIKE</option>
                        <option value="model" {{ request('mode') === 'model' ? 'selected' : '' }}>MODEL</option>
                        <option value="scout" {{ request('mode') === 'scout' ? 'selected' : '' }}>SCOUT</option>
                    </select>
                    <button class="shop-search-btn" type="submit" aria-label="Search">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="#666"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    </button>
                </form>
            </div>

            <div class="shop-header-right">
                <a class="shop-pill" href="{{ route('home') }}">Home</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a class="shop-pill" href="{{ route('admin.dashboard') }}">Admin</a>
                    @else
                        @php
                            $cartCount = (int) auth()->user()->cart()->sum('quantity');
                        @endphp
                        <a class="shop-icon-pill" href="{{ route('cart.index') }}" aria-label="Cart">
                            <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.44A1.996 1.996 0 0 0 7 17h12v-2H7.42a.25.25 0 0 1-.22-.37l.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03L21 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2z"/></svg>
                            <span class="shop-cart-count">{{ $cartCount }}</span>
                        </a>
                        <a class="shop-pill" href="{{ route('orders.index') }}">Orders</a>
                    @endif
                @else
                    <a class="shop-pill" href="{{ route('auth.login') }}">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="shop-body">
        <div class="safe-area shop-grid">
            <aside class="filter-panel">
                <h3>Filters</h3>

                <form action="{{ route('shop.filter') }}" method="GET">
                    <div class="filter-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="filter-input">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="price_min">Price Range</label>
                        <input id="price_min" type="number" name="price_min" class="filter-input" placeholder="Min price" value="{{ request('price_min') }}">
                    </div>

                    <div class="filter-group">
                        <input type="number" name="price_max" class="filter-input" placeholder="Max price" value="{{ request('price_max') }}">
                    </div>

                    <div class="filter-group">
                        <label for="brand">Brand</label>
                        <input id="brand" type="text" name="brand" class="filter-input" placeholder="Brand name" value="{{ request('brand') }}">
                    </div>

                    <div class="filter-group">
                        <label for="type">Type</label>
                        <input id="type" type="text" name="type" class="filter-input" placeholder="Product type" value="{{ request('type') }}">
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn-filter-primary">Apply Filters</button>
                        <a href="{{ route('shop.index') }}" class="btn-filter-clear">Clear</a>
                    </div>
                </form>
            </aside>

            <section>
                <div class="products-head">
                    <h1 class="products-title">
                        @if(isset($query))
                            Search Results for "{{ $query }}" ({{ strtoupper($mode ?? 'like') }})
                        @else
                            {{ request('category') ? 'Filtered Products' : 'All Products' }}
                        @endif
                    </h1>
                    <span class="items-badge">{{ $products->count() }} items</span>
                </div>

                @if($products->isEmpty())
                    <div class="empty-state">
                        No products found. Try adjusting your filters.
                    </div>
                @else
                    <div class="product-grid">
                    @foreach($products as $product)
                        <article class="product-card">
                            <div class="product-image-wrap">
                                @if($product->photos->count() > 0)
                                    <img src="{{ asset('storage/' . $product->photos->first()->photo_path) }}" alt="{{ $product->name }}">
                                @else
                                    <span>No image</span>
                                @endif
                            </div>

                            <div class="product-card-body">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="product-cat">{{ $product->category->name }}</div>
                                <div class="product-desc">{{ Str::limit($product->description, 60) }}</div>

                                <div>
                                    <span class="product-price">PHP {{ number_format($product->price, 2) }}</span>
                                    @if($product->stock > 0)
                                        <span class="product-stock in">In Stock</span>
                                    @else
                                        <span class="product-stock out">Out of Stock</span>
                                    @endif
                                </div>

                                @if($product->reviews->count() > 0)
                                    <div class="product-rating">
                                        @php
                                            $avgRating = $product->reviews->avg('rating');
                                        @endphp
                                        {{ number_format((float) $avgRating, 1) }}/5 ({{ $product->reviews->count() }} reviews)
                                    </div>
                                @endif
                            </div>

                            <div class="product-actions">
                                <a href="{{ route('shop.product.show', $product) }}" class="view-btn">View Details</a>
                            </div>
                        </article>
                    @endforeach
                    </div>

                    <div class="shop-pagination">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </section>
        </div>
    </main>

    <footer class="shop-footer">
        <div class="safe-area shop-footer-inner">
            <small>© 2026 PokeStop Center Management</small>
            <a href="{{ route('home') }}">Back to home</a>
        </div>
    </footer>

    <button id="floatingTopBtn" class="floating-top-btn" type="button" aria-label="Back to top">↑</button>
</div>
@endsection

@section('extra-scripts')
<script>
    (function () {
        const topButton = document.getElementById('floatingTopBtn');

        function syncTopButton() {
            if (window.scrollY > 360) {
                topButton.classList.add('show');
            } else {
                topButton.classList.remove('show');
            }
        }

        window.addEventListener('scroll', syncTopButton);
        syncTopButton();

        topButton.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
</script>
@endsection
