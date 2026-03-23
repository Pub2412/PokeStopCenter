@extends('layouts.app')

@section('title', $product->name)

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
        color: #333;
        margin: 0;
        overflow-x: hidden;
    }

    .detail-wrap,
    .detail-wrap * {
        box-sizing: border-box;
    }

    .detail-wrap a {
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

    .detail-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(to bottom, #f6cf57 60%, rgba(246, 207, 87, 0.8) 80%, rgba(246, 207, 87, 0) 100%);
        padding-bottom: 24px;
    }

    .detail-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        padding-top: 16px;
        padding-bottom: 14px;
    }

    .detail-header-left,
    .detail-header-right {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .detail-header-left {
        justify-content: flex-start;
    }

    .detail-header-right {
        justify-content: flex-end;
        gap: 10px;
    }

    .detail-logo img {
        height: 52px;
        width: auto;
        display: block;
    }

    .detail-pill {
        background: linear-gradient(180deg, #fdf6d8 0%, #e8d88c 100%);
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .detail-icon-pill {
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

    .detail-icon-pill svg {
        width: 22px;
        height: 22px;
        fill: #1a1a1a;
    }

    .detail-cart-count {
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

    .product-detail-main {
        padding: 18px 0 60px;
    }

    .product-hero {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
        padding: 28px;
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 30px;
        align-items: start;
        margin-bottom: 20px;
    }

    .product-hero-image {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 16px;
        object-fit: contain;
        background: #fafafa;
        display: block;
    }

    .thumb-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 8px;
        margin-top: 10px;
    }

    .thumb-grid button {
        border: 2px solid transparent;
        background: #fff;
        border-radius: 10px;
        padding: 0;
        cursor: pointer;
    }

    .thumb-grid button.active {
        border-color: #daa520;
    }

    .thumb-grid img {
        width: 100%;
        height: 78px;
        object-fit: cover;
        border-radius: 8px;
        display: block;
    }

    .empty-image {
        width: 100%;
        aspect-ratio: 1;
        border-radius: 16px;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #777;
        font-weight: 600;
    }

    .product-title {
        font-size: clamp(24px, 3vw, 32px);
        font-weight: 800;
        line-height: 1.2;
        color: #1a1a1a;
        margin: 0;
    }

    .product-meta {
        font-size: 14px;
        color: #555;
        margin-top: 6px;
    }

    .product-price {
        font-size: 28px;
        font-weight: 700;
        color: #c8930a;
        margin: 10px 0 8px;
    }

    .product-rating {
        font-size: 14px;
        color: #666;
        margin-bottom: 14px;
    }

    .quantity-row {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        background: #f0f0f0;
        border-radius: 999px;
        overflow: hidden;
    }

    .qty-btn {
        width: 42px;
        height: 42px;
        border: none;
        background: transparent;
        font-size: 22px;
        font-weight: 700;
        line-height: 1;
        color: #333;
        cursor: pointer;
    }

    .qty-input {
        width: 52px;
        text-align: center;
        border: none;
        outline: none;
        background: transparent;
        font-size: 16px;
        font-weight: 700;
    }

    .hero-add-to-cart {
        width: 100%;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        border-radius: 50px;
        border: none;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
    }

    .hero-login-btn {
        display: inline-block;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        border-radius: 50px;
        padding: 12px 20px;
        font-size: 15px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .section-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
        padding: 28px;
        margin-bottom: 20px;
    }

    .section-title {
        font-family: 'Russo One', sans-serif;
        font-size: 26px;
        margin-bottom: 14px;
        color: #1a1a1a;
    }

    .description-text {
        font-size: 15px;
        line-height: 1.7;
        color: #333;
    }

    .review-form {
        background: #f8f8f8;
        border-radius: 14px;
        padding: 12px;
        margin-bottom: 14px;
    }

    .review-form .btn {
        border-radius: 999px;
        font-weight: 700;
    }

    .review-item {
        background: #f8f8f8;
        border-radius: 14px;
        padding: 14px;
        margin-bottom: 10px;
    }

    .review-head {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 4px;
        font-size: 14px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 14px;
    }

    .related-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .related-card img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        background: #ececec;
    }

    .related-body {
        padding: 10px;
    }

    .related-title {
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .related-price {
        font-size: 13px;
        color: #555;
        margin-bottom: 8px;
    }

    .related-btn {
        display: inline-block;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        border-radius: 999px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 700;
    }

    .detail-footer {
        background: #222;
        color: #fff;
        padding: 24px 0;
    }

    .detail-footer-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .detail-footer small {
        color: #d2d2d2;
    }

    .detail-footer a {
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

    @media (max-width: 980px) {
        .product-hero {
            grid-template-columns: 1fr;
        }

        .related-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 860px) {
        .detail-header-top {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 640px) {
        .related-grid {
            grid-template-columns: 1fr;
        }

        .detail-footer-inner {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="detail-wrap" id="top">
    <header class="detail-header">
        <div class="safe-area detail-header-top">
            <div class="detail-header-left">
                <div class="detail-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center">
                    </a>
                </div>
            </div>

            <div class="detail-header-right">
                <a class="detail-pill" href="{{ route('shop.index') }}">Products</a>
                @auth
                    @if(auth()->user()->role !== 'admin')
                        @php
                            $cartCount = (int) auth()->user()->cart()->sum('quantity');
                        @endphp
                        <a class="detail-icon-pill" href="{{ route('cart.index') }}" aria-label="Cart">
                            <svg viewBox="0 0 24 24"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.44A1.996 1.996 0 0 0 7 17h12v-2H7.42a.25.25 0 0 1-.22-.37l.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03L21 4H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2S15.9 22 17 22s2-.9 2-2-.9-2-2-2z"/></svg>
                            <span class="detail-cart-count">{{ $cartCount }}</span>
                        </a>
                    @else
                        <a class="detail-pill" href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                @else
                    <a class="detail-pill" href="{{ route('auth.login') }}">Login</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="product-detail-main">
        <div class="safe-area">
            <section class="product-hero">
                <div>
                    @if($product->photos->count())
                        <img id="primaryProductImage" src="{{ asset('storage/' . $product->photos->first()->photo_path) }}" class="product-hero-image" alt="{{ $product->name }}">

                        @if($product->photos->count() > 1)
                            <div class="thumb-grid">
                                @foreach($product->photos as $photo)
                                    <button type="button" class="product-thumb-btn {{ $loop->first ? 'active' : '' }}" data-image="{{ asset('storage/' . $photo->photo_path) }}" aria-label="Photo {{ $loop->iteration }}">
                                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Photo {{ $loop->iteration }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="empty-image">There is none</div>
                    @endif
                </div>

                <div>
                    <h1 class="product-title">{{ $product->name }}</h1>
                    <div class="product-meta">{{ $product->brand }} | {{ $product->type }} | Category: {{ $product->category->name ?? 'N/A' }}</div>

                    <div class="product-price">PHP {{ number_format($product->price, 2) }}</div>

                    <div class="product-rating">
                        @php
                            $avg = (float) $product->reviews->avg('rating');
                        @endphp
                        {{ number_format($avg, 1) }}/5 ({{ $product->reviews->count() }} reviews)
                    </div>

                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <div class="quantity-row">
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn" data-qty-action="decrease">-</button>
                                        <input id="detailQuantity" type="number" min="1" max="100" name="quantity" value="1" class="qty-input" required>
                                        <button type="button" class="qty-btn" data-qty-action="increase">+</button>
                                    </div>
                                    <span style="color:#666; font-size:14px;">Max 100</span>
                                </div>
                                <button type="submit" class="hero-add-to-cart">Add to Cart</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('auth.login') }}" class="hero-login-btn">Login to Purchase</a>
                    @endauth
                </div>
            </section>

            <section class="section-card">
                <h2 class="section-title">Description</h2>
                <div class="description-text">{{ $product->description }}</div>
            </section>

            <section class="section-card">
                <h2 class="section-title">Ratings & Reviews</h2>

                @auth
                    @if(auth()->user()->role !== 'admin' && $userHasPurchased)
                        @if($existingUserReview)
                            <form method="POST" action="{{ route('reviews.update', $existingUserReview) }}" class="review-form">
                                @csrf
                                @method('PUT')
                                <div class="row g-2">
                                    <div class="col-md-2">
                                        <select name="rating" class="form-select" required>
                                            @for($i=1; $i<=5; $i++)
                                                <option value="{{ $i }}" @selected($existingUserReview->rating == $i)>{{ str_repeat('⭐', $i) }} {{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="comment" class="form-control" value="{{ $existingUserReview->comment }}" required>
                                    </div>
                                    <div class="col-md-2 d-flex gap-2">
                                        <button class="btn btn-primary w-100" type="submit">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('reviews.destroy', $existingUserReview) }}" class="mb-3">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Delete My Review</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('reviews.store', $product) }}" class="review-form">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-md-2">
                                        <select name="rating" class="form-select" required>
                                            <option value="">Rating</option>
                                            @for($i=1; $i<=5; $i++)
                                                <option value="{{ $i }}">{{ str_repeat('⭐', $i) }} {{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" name="comment" class="form-control" placeholder="Write your review" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100" type="submit">Post</button>
                                    </div>
                                </div>
                            </form>
                        @endif
                    @endif
                @endauth

                @forelse($product->reviews as $review)
                    <article class="review-item">
                        <div class="review-head">
                            <strong>{{ $review->user->fname }} {{ $review->user->lname }}</strong>
                            <span>
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="{{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}">★</span>
                                @endfor
                            </span>
                        </div>
                        <div>{{ $review->comment }}</div>
                    </article>
                @empty
                    <p class="mb-0">There is none</p>
                @endforelse
            </section>

            <section class="section-card">
                <h2 class="section-title">Related Products</h2>
                <div class="related-grid">
                    @forelse($relatedProducts as $related)
                        <article class="related-card">
                            @if($related->photos->first())
                                <img src="{{ asset('storage/' . $related->photos->first()->photo_path) }}" alt="{{ $related->name }}">
                            @endif
                            <div class="related-body">
                                <div class="related-title">{{ $related->name }}</div>
                                <div class="related-price">PHP {{ number_format($related->price, 2) }}</div>
                                <a href="{{ route('shop.product.show', $related) }}" class="related-btn">View</a>
                            </div>
                        </article>
                    @empty
                        <p>There is none</p>
                    @endforelse
                </div>
            </section>
        </div>
    </main>

    <footer class="detail-footer">
        <div class="safe-area detail-footer-inner">
            <small>© 2026 PokeStop Center Management</small>
            <a href="{{ route('shop.index') }}">Back to products</a>
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
        const imageEl = document.getElementById('primaryProductImage');
        const thumbButtons = document.querySelectorAll('.product-thumb-btn');

        thumbButtons.forEach((btn) => {
            btn.addEventListener('click', function () {
                if (!imageEl) {
                    return;
                }

                imageEl.src = btn.dataset.image;
                thumbButtons.forEach((x) => x.classList.remove('active'));
                btn.classList.add('active');
            });
        });

        const qtyInput = document.getElementById('detailQuantity');
        const qtyBtns = document.querySelectorAll('[data-qty-action]');

        qtyBtns.forEach((btn) => {
            btn.addEventListener('click', function () {
                if (!qtyInput) {
                    return;
                }

                const current = parseInt(qtyInput.value || '1', 10);
                const min = parseInt(qtyInput.min || '1', 10);
                const max = parseInt(qtyInput.max || '100', 10);
                const next = btn.dataset.qtyAction === 'increase' ? current + 1 : current - 1;

                qtyInput.value = String(Math.max(min, Math.min(max, next)));
            });
        });

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
