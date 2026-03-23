@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Russo+One&display=swap" rel="stylesheet">
<style>
    body > nav.navbar,
    body > footer.mt-5,
    body > .container.mt-3 { display: none; }

    body {
        margin: 0;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(160deg, #ead07b 0%, #d0a944 55%, #b48c30 100%);
        min-height: 100vh;
    }

    .page-wrap, .page-wrap * { box-sizing: border-box; }
    .page-wrap a { text-decoration: none; color: inherit; }
    .safe-area { width: 100%; max-width: 1120px; margin: 0 auto; padding: 0 28px; }

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

    .header-left, .header-right {
        flex: 1;
        display: flex;
        align-items: center;
    }
    .header-right { justify-content: flex-end; gap: 10px; }
    .logo img { height: 52px; width: auto; display: block; }

    .pill {
        background: linear-gradient(180deg, #fdf6d8 0%, #e6d389 100%);
        border-radius: 999px;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .back-btn {
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 700;
        background: #f1f1f1;
        color: #333;
    }

    .content { padding: 14px 0 64px; }
    .title-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
        flex-wrap: wrap;
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

    .layout {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 14px;
    }

    .box {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,.15);
        overflow: hidden;
    }

    .box-head {
        padding: 12px 14px;
        font-weight: 700;
        border-bottom: 1px solid #ececec;
        background: #faf7ea;
    }

    .table-wrap { overflow-x: auto; }
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th, .items-table td {
        padding: 11px 10px;
        border-bottom: 1px solid #ececec;
        font-size: 14px;
    }
    .items-table th { text-align: left; font-weight: 700; }
    .empty-cell { text-align: center; padding: 20px; color: #666; }

    .box-body { padding: 14px; font-size: 14px; }
    .box-body p { margin: 0 0 6px; }

    .pay-select {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 9px 10px;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .pay-btn {
        width: 100%;
        border: none;
        border-radius: 999px;
        padding: 11px 12px;
        font-size: 14px;
        font-weight: 700;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        color: #1a1a1a;
        cursor: pointer;
    }

    .floating-top-btn {
        position: fixed; right: 20px; bottom: 24px; width: 46px; height: 46px; border-radius: 50%;
        border: none; background: #0C243D; color: #fff; font-size: 22px; line-height: 1;
        box-shadow: 0 8px 20px rgba(0,0,0,.35); cursor: pointer; opacity: 0;
        transform: translateY(12px); pointer-events: none;
        transition: opacity .2s ease, transform .2s ease; z-index: 1200;
    }
    .floating-top-btn.show { opacity: 1; transform: translateY(0); pointer-events: auto; }

    @media (max-width: 980px) {
        .layout { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-wrap" id="top">
    <header class="page-header">
        <div class="safe-area page-header-top">
            <div class="header-left">
                <a class="logo" href="{{ route('home') }}"><img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center"></a>
            </div>
            <div class="header-right">
                <a href="{{ route('shop.index') }}" class="back-btn">Go Back</a>
            </div>
        </div>
    </header>

    <main class="content">
        <div class="safe-area">
            <div class="title-row">
                <h1>Order #{{ $order->id }}</h1>
                <a href="{{ route('orders.index') }}" class="back-btn">Back to Orders</a>
            </div>

            <div class="layout">
                <div class="box">
                    <div class="box-head">Items</div>
                    <div class="table-wrap">
                        <table class="items-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₱{{ number_format($item->unit_price, 2) }}</td>
                                        <td>₱{{ number_format($item->quantity * $item->unit_price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="empty-cell">There is none</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

                <div class="box">
                    <div class="box-head">Order Summary</div>
                    <div class="box-body">
                        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                        <p><strong>Total:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at?->format('M d, Y h:i A') }}</p>
                    </div>
                </div>

                @if($order->status === 'pending')
                    <div class="box">
                        <div class="box-head">Shipping Address</div>
                        <div class="box-body">
                            <p style="margin-bottom: 0; color: #555; line-height: 1.6;">{{ $order->shipping_address }}</p>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-head">Payment</div>
                        <div class="box-body">
                            <form method="POST" action="{{ route('orders.pay', $order) }}">
                                @csrf
                                <label for="payment_method" style="display: block; margin-bottom: 8px; font-weight: 600;">Payment Method</label>
                                <select id="payment_method" class="pay-select" name="payment_method" required onchange="toggleCardFields()">
                                    <option value="">-- Select Payment Method --</option>
                                    <option value="credit_card">Credit Card</option>
                                    <option value="debit_card">Debit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>

                                <div id="card-fields" style="display: none; margin-top: 12px;">
                                    <label for="card_number" style="display: block; margin-bottom: 6px; font-weight: 600; margin-top: 10px;">Card Number</label>
                                    <input type="text" id="card_number" name="card_number" class="pay-select" placeholder="1234 5678 9012 3456" maxlength="19">
                                    @error('card_number')<span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>@enderror

                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 8px;">
                                        <div>
                                            <label for="expiry" style="display: block; margin-bottom: 6px; font-weight: 600;">Expiry (MM/YY)</label>
                                            <input type="text" id="expiry" name="expiry" class="pay-select" placeholder="12/26" maxlength="5">
                                            @error('expiry')<span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>@enderror
                                        </div>
                                        <div>
                                            <label for="cvv" style="display: block; margin-bottom: 6px; font-weight: 600;">CVV</label>
                                            <input type="text" id="cvv" name="cvv" class="pay-select" placeholder="123" maxlength="4">
                                            @error('cvv')<span style="color: #dc3545; font-size: 12px;">{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <p style="font-size: 12px; color: #999; margin-top: 10px;">
                                        <i>Your card details are not stored and are for educational purposes only.</i>
                                    </p>
                                </div>

                                <button type="submit" class="pay-btn" style="margin-top: 12px;">Pay Now</button>
                            </form>
                        </div>
                    </div>
                @elseif($order->status === 'in_transit')
                    <div class="box">
                        <div class="box-head">Status</div>
                        <div class="box-body">
                            <p style="color: #3B4CCA; font-weight: 700; margin-bottom: 8px;">✓ In Transit</p>
                            <p style="font-size: 13px; color: #999;">Your order has been paid and is on its way to you.</p>
                        </div>
                    </div>
                @elseif($order->transaction)
                    <div class="box">
                        <div class="box-head">Transaction</div>
                        <div class="box-body">
                            <p><strong>Reference:</strong> {{ $order->transaction->transaction_ref }}</p>
                            <p><strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $order->transaction->payment_method)) }}</p>
                            <p><strong>Status:</strong> {{ ucfirst($order->transaction->status) }}</p>
                        </div>
                    </div>
                @endif
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
            if (window.scrollY > 360) topButton.classList.add('show');
            else topButton.classList.remove('show');
        }
        window.addEventListener('scroll', syncTopButton);
        syncTopButton();
        topButton.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();

    // Toggle card fields based on payment method
    function toggleCardFields() {
        const method = document.getElementById('payment_method').value;
        const cardFields = document.getElementById('card-fields');
        const cardNumber = document.getElementById('card_number');
        const expiry = document.getElementById('expiry');
        const cvv = document.getElementById('cvv');

        if (method === 'credit_card' || method === 'debit_card') {
            cardFields.style.display = 'block';
            cardNumber.required = true;
            expiry.required = true;
            cvv.required = true;
        } else {
            cardFields.style.display = 'none';
            cardNumber.required = false;
            expiry.required = false;
            cvv.required = false;
        }
    }
</script>
@endsection
