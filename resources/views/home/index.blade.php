@extends('layouts.app')

@section('title', 'PokeStop Center')

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
        background-color: #555;
        background-image: url('{{ asset('template/index/loopingbg.png') }}');
        background-repeat: repeat;
        background-position: center 0;
        min-height: 100vh;
        color: #222;
        margin: 0;
        overflow-x: hidden;
    }

    .landing-wrap,
    .landing-wrap * {
        box-sizing: border-box;
    }

    .landing-wrap a {
        text-decoration: none;
        color: inherit;
    }

    .safe-area {
        width: 100%;
        max-width: 1120px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 28px;
        padding-right: 28px;
    }

    .header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(to bottom, #f6cf57 60%, rgba(246, 207, 87, 0.8) 80%, rgba(246, 207, 87, 0) 100%);
        padding-bottom: 26px;
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        padding-top: 16px;
        padding-bottom: 14px;
    }

    .header-left,
    .header-right {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .header-left {
        justify-content: flex-start;
    }

    .header-right {
        justify-content: flex-end;
        gap: 10px;
    }

    .logo img {
        height: 52px;
        width: auto;
        display: block;
    }

    .header-pill {
        background: linear-gradient(180deg, #fdf6d8 0%, #e8d88c 100%);
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .icon-pill {
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

    .icon-pill svg {
        width: 22px;
        height: 22px;
        fill: #1a1a1a;
    }

    .cart-count {
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

    .logout-form {
        margin: 0;
    }

    .logout-btn {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: linear-gradient(180deg, #fdf6d8 0%, #e8d88c 100%);
        border-radius: 50px;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: none;
        cursor: pointer;
    }

    .logout-btn svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
    }

    .profile-pill {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #f1f1f1;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .profile-pill svg {
        width: 24px;
        height: 24px;
        fill: #888;
    }

    .profile-pill img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .hero-carousel {
        padding: 10px 0 14px;
    }

    .hero-frame {
        width: min(1024px, 92vw);
        height: clamp(210px, 38vw, 420px);
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25);
        margin: 0 auto;
        background: #f8f8f8;
    }

    .hero-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    .hero-dots {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 16px;
    }

    .hero-dot {
        width: 12px;
        height: 12px;
        border-radius: 20px;
        background: rgba(60, 60, 60, 0.35);
        border: none;
        padding: 0;
    }

    .hero-dot.active {
        width: 38px;
        background: rgba(60, 60, 60, 0.82);
    }

    .products-section {
        padding: 24px 0 70px;
    }

    .products-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .products-heading h2 {
        font-family: 'Russo One', sans-serif;
        font-size: clamp(22px, 2.8vw, 34px);
        margin: 0;
        color: #f6cf57;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.35);
    }

    .products-heading a {
        color: #fff;
        font-weight: 600;
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
    }

    .product-card-image {
        width: 100%;
        aspect-ratio: 4 / 3;
        border-radius: 14px;
        overflow: hidden;
        background: #e8e8e8;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card-image img {
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
        color: #1a1a1a;
    }

    .product-price {
        font-size: 14px;
        color: #444;
        margin-bottom: 6px;
    }

    .product-rating {
        font-size: 13px;
        color: #666;
        margin-bottom: 4px;
    }

    .product-actions {
        display: flex;
        gap: 10px;
        padding: 8px 6px 4px;
        margin-top: auto;
        align-items: center;
    }

    .shop-now-btn {
        flex: 1;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        border-radius: 50px;
        padding: 9px 16px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        text-align: center;
    }

    .footer {
        background: #222;
        color: #fff;
        padding: 44px 0 28px;
    }

    .footer-tagline {
        text-align: center;
        font-size: 18px;
        font-style: italic;
        font-weight: 700;
        margin-bottom: 34px;
    }

    .footer-bottom {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .footer-bottom small {
        color: #cfcfcf;
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

    @media (max-width: 960px) {
        .header-top {
            flex-wrap: wrap;
        }

        .product-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 680px) {
        .product-grid {
            grid-template-columns: 1fr;
        }

        .header-right {
            gap: 8px;
        }

        .header-pill {
            padding: 8px 14px;
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="landing-wrap" id="top">
    <header class="header">
        <div class="safe-area header-top">
            <div class="header-left">
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center">
                    </a>
                </div>
            </div>

            <div class="header-right">
                <a class="header-pill" href="{{ route('shop.index') }}">Shop</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a class="header-pill" href="{{ route('admin.dashboard') }}">Admin</a>
                        <a class="profile-pill" href="{{ route('admin.dashboard') }}" aria-label="Admin panel">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile photo">
                            @else
                                <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            @endif
                        </a>
                    @else
                        @php
                            $cartCount = (int) auth()->user()->cart()->sum('quantity');
                        @endphp
                        <a class="icon-pill" href="{{ route('cart.index') }}" aria-label="Cart">
                            <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.44A1.996 1.996 0 0 0 7 17h12v-2H7.42a.25.25 0 0 1-.22-.37l.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03L21 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2z"/></svg>
                            <span class="cart-count">{{ $cartCount }}</span>
                        </a>
                        <a class="profile-pill" href="{{ route('profile.show') }}" aria-label="Profile">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}" alt="Profile photo">
                            @else
                                <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            @endif
                        </a>
                    @endif

                    <form class="logout-form" action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        <button class="logout-btn" type="submit" aria-label="Logout">
                            <svg viewBox="0 0 24 24"><path d="M10.09 15.59 11.5 17l5-5-5-5-1.41 1.41L12.67 11H3v2h9.67zM19 3H5c-1.11 0-2 .9-2 2v4h2V5h14v14H5v-4H3v4c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/></svg>
                            Logout
                        </button>
                    </form>
                @else
                    <a class="header-pill" href="{{ route('auth.login') }}">Login</a>
                @endauth
            </div>
        </div>

    </header>

    <main>
        <section class="hero-carousel">
            <div class="hero-frame">
                <img id="heroBanner" src="{{ asset('template/index/Banner1.png') }}" alt="Promo banner">
            </div>
            <div class="hero-dots">
                <button class="hero-dot active" type="button" data-banner="{{ asset('template/index/Banner1.png') }}" aria-label="Banner 1"></button>
                <button class="hero-dot" type="button" data-banner="{{ asset('template/index/banner2.png') }}" aria-label="Banner 2"></button>
            </div>
        </section>

        <section class="products-section safe-area" id="featured">
            <div class="products-heading">
                <h2>Featured Picks</h2>
                <a href="{{ route('shop.index') }}">Browse all products</a>
            </div>

            <div class="product-grid">
                @forelse($featuredProducts as $product)
                    <article class="product-card">
                        <div class="product-card-image">
                            @if($product->photos->count() > 0)
                                <img src="{{ asset('storage/' . $product->photos->first()->photo_path) }}" alt="{{ $product->name }}">
                            @else
                                <span>No image</span>
                            @endif
                        </div>

                        <div class="product-card-body">
                            <div class="product-name">{{ \Illuminate\Support\Str::limit($product->name, 40) }}</div>
                            <div class="product-price">PHP {{ number_format($product->price, 2) }}</div>
                            <div class="product-rating">
                                {{ number_format((float) $product->reviews->avg('rating'), 1) }}/5 ({{ $product->reviews->count() }} reviews)
                            </div>
                        </div>

                        <div class="product-actions">
                            <a class="shop-now-btn" href="{{ route('shop.product.show', $product) }}">View Product</a>
                        </div>
                    </article>
                @empty
                    <article class="product-card" style="grid-column:1/-1; text-align:center; padding:26px;">
                        No featured products yet. Visit the shop to explore available items.
                    </article>
                @endforelse
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="safe-area">
            <p class="footer-tagline">Your One-Stop Shop for all things Pokemon!</p>
            <div class="footer-bottom">
                <small>© 2026 PokeStop Center Management</small>
            </div>
        </div>
    </footer>

    <button id="floatingTopBtn" class="floating-top-btn" type="button" aria-label="Back to top">↑</button>
</div>
@endsection

@section('extra-scripts')
<script>
    window.addEventListener('scroll', function () {
        const scrollPosition = window.scrollY || 0;
        document.body.style.backgroundPositionY = -(scrollPosition * 0.25) + 'px';
    });

    (function () {
        const topButton = document.getElementById('floatingTopBtn');
        const banner = document.getElementById('heroBanner');
        const dots = document.querySelectorAll('.hero-dot');
        let active = 0;

        function activate(index) {
            active = index;
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            banner.src = dots[index].dataset.banner;
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', function () {
                activate(index);
            });
        });

        setInterval(function () {
            activate((active + 1) % dots.length);
        }, 5000);

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
