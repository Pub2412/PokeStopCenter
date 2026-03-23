@extends('layouts.app')

@section('title', 'Checkout')

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

    .back-btn {
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 700;
        background: #f1f1f1;
        color: #333;
    }

    .card-box {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 600px;
        margin: 0 auto;
    }

    .card-head {
        padding: 16px;
        font-weight: 700;
        border-bottom: 1px solid #ececec;
        background: #faf7ea;
    }

    .card-body {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 14px;
    }

    .form-input {
        width: 100%;
        border: 1.5px solid #ddd;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.2s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #e0b946;
        box-shadow: 0 0 0 3px rgba(224, 185, 70, 0.1);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn {
        border: none;
        border-radius: 999px;
        padding: 12px 20px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        flex: 1;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        color: #1a1a1a;
    }

    .btn-primary:hover {
        filter: brightness(0.95);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    }

    .btn-secondary {
        background: #f1f1f1;
        color: #333;
    }

    .btn-secondary:hover {
        background: #e8e8e8;
    }

    .order-summary {
        background: #faf7ea;
        border-radius: 12px;
        padding: 14px;
        margin-top: 16px;
    }

    .order-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .order-summary-row:last-child {
        margin-bottom: 0;
        border-top: 1px solid #ddd;
        padding-top: 8px;
        margin-top: 8px;
    }

    .order-summary-row:last-child {
        font-weight: 700;
        color: #0c243d;
    }
</style>
@endsection

@section('content')
<div class="page-wrap">
    <header class="page-header">
        <div class="safe-area page-header-top">
            <div class="header-left">
                <a class="logo" href="{{ route('home') }}">
                    <img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center">
                </a>
            </div>
            <div class="header-right">
                <a class="pill" href="{{ route('shop.index') }}">Products</a>
                <a class="pill" href="{{ route('cart.index') }}">Cart</a>
            </div>
        </div>
    </header>

    <main class="content">
        <div class="safe-area">
            <div class="title-row">
                <h1>Checkout</h1>
                <a href="{{ route('cart.index') }}" class="back-btn">Back to Cart</a>
            </div>

            <div class="card-box">
                <div class="card-head">Shipping Address</div>
                <div class="card-body">
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="street_address">Street Address *</label>
                            <input 
                                type="text" 
                                id="street_address" 
                                name="street_address" 
                                class="form-input @error('street_address') is-invalid @enderror" 
                                value="{{ old('street_address') }}"
                                placeholder="e.g., 123 Main Street, Apartment 4B"
                                required
                            >
                            @error('street_address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City *</label>
                                <input 
                                    type="text" 
                                    id="city" 
                                    name="city" 
                                    class="form-input @error('city') is-invalid @enderror" 
                                    value="{{ old('city') }}"
                                    placeholder="e.g., Manila"
                                    required
                                >
                                @error('city')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="province">Province/State *</label>
                                <input 
                                    type="text" 
                                    id="province" 
                                    name="province" 
                                    class="form-input @error('province') is-invalid @enderror" 
                                    value="{{ old('province') }}"
                                    placeholder="e.g., Metro Manila"
                                    required
                                >
                                @error('province')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="postal_code">Postal Code *</label>
                                <input 
                                    type="text" 
                                    id="postal_code" 
                                    name="postal_code" 
                                    class="form-input @error('postal_code') is-invalid @enderror" 
                                    value="{{ old('postal_code') }}"
                                    placeholder="e.g., 1000"
                                    required
                                >
                                @error('postal_code')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="country">Country *</label>
                                <input 
                                    type="text" 
                                    id="country" 
                                    name="country" 
                                    class="form-input @error('country') is-invalid @enderror" 
                                    value="{{ old('country') }}"
                                    placeholder="e.g., Philippines"
                                    required
                                >
                                @error('country')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="order-summary">
                            @foreach($cartItems as $item)
                                <div class="order-summary-row">
                                    <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                                    <span>₱{{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                </div>
                            @endforeach
                            <div class="order-summary-row">
                                <span>Total</span>
                                <span>₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('cart.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Confirm & Proceed to Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
