@extends('layouts.app')

@section('title', 'My Cart')

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Russo+One&display=swap" rel="stylesheet">
<style>
    body > nav.navbar,
    body > footer.mt-5,
    body > .container.mt-3 {
        display: none;
    }

    body {
        margin: 0;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(160deg, #ead07b 0%, #d0a944 55%, #b48c30 100%);
        min-height: 100vh;
    }

    .page-wrap,
    .page-wrap * {
        box-sizing: border-box;
    }

    .page-wrap a {
        text-decoration: none;
        color: inherit;
    }

    .safe-area {
        width: 100%;
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 28px;
    }

    .page-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(to bottom, #e0b946 62%, rgba(224, 185, 70, 0.82) 82%, rgba(224, 185, 70, 0) 100%);
        padding-bottom: 20px;
    }

    .page-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 14px 0;
    }

    .header-left,
    .header-right {
        flex: 1;
        display: flex;
        align-items: center;
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

    .pill {
        background: linear-gradient(180deg, #fdf6d8 0%, #e6d389 100%);
        border-radius: 999px;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .back-btn {
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 700;
        background: #f1f1f1;
        color: #333;
    }
    .content {
        padding: 14px 0 64px;
    }

    .title-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        gap: 8px;
    }

    .title-row h1 {
        margin: 0;
        font-family: 'Russo One', sans-serif;
        font-size: clamp(24px, 3vw, 34px);
        color: #1a1a1a;
    }

    .card-box {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .table-wrap {
        overflow-x: auto;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table th,
    .cart-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #ececec;
        font-size: 14px;
        vertical-align: middle;
    }

    .cart-table th {
        text-align: left;
        background: #faf7ea;
        font-weight: 700;
    }

    .qty-form {
        display: flex;
        gap: 6px;
        align-items: center;
        max-width: 180px;
    }

    .qty-input {
        width: 72px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 6px 8px;
        font-size: 13px;
    }

    .btn-small {
        border: none;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-save {
        background: #0c243d;
        color: #fff;
    }

    .btn-remove {
        background: #d93939;
        color: #fff;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 16px;
        flex-wrap: wrap;
    }

    .summary-row strong {
        font-size: 20px;
        color: #0c243d;
    }

    .btn-checkout {
        border: none;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        border-radius: 999px;
        padding: 11px 18px;
        font-size: 14px;
        font-weight: 700;
        color: #1a1a1a;
        cursor: pointer;
    }

    .empty-cell {
        text-align: center;
        padding: 28px;
        color: #666;
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
</style>
@endsection

@section('content')
<div class="page-wrap" id="top">
    <header class="page-header">
        <div class="safe-area page-header-top">
            <div class="header-left">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center">
                </a>
            </div>
            <div class="header-right">
                <a href="{{ route('shop.index') }}" class="back-btn">Go Back</a>
            </div>
        </div>
    </header>

    <main class="content">
        <div class="safe-area">
            <div class="title-row">
                <h1>My Cart</h1>
            </div>

            <div class="card-box">
                <div class="table-wrap">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>₱{{ number_format($item->product->price ?? 0, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="qty-form">
                                            @csrf
                                            <input type="number" class="qty-input" name="quantity" min="1" max="100" value="{{ $item->quantity }}">
                                            <button class="btn-small btn-save" type="submit">Save</button>
                                        </form>
                                    </td>
                                    <td>₱{{ number_format(($item->product->price ?? 0) * $item->quantity, 2) }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-small btn-remove" type="submit">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-cell">There is none</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="summary-row">
                    <strong>Total: ₱{{ number_format($total, 2) }}</strong>
                    @if($cartItems->count())
                        <a href="{{ route('cart.checkout') }}" class="btn-checkout">Proceed to Checkout</a>
                    @endif
                </div>
            </div>
        </div>
    </main>

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
