@extends('layouts.app')

@section('title', 'My Orders')

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

    .content { padding: 14px 0 64px; }
    .title-row { margin-bottom: 16px; }
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

    .table-wrap { overflow-x: auto; }
    .orders-table { width: 100%; border-collapse: collapse; }
    .orders-table th, .orders-table td {
        padding: 12px 10px;
        border-bottom: 1px solid #ececec;
        font-size: 14px;
        vertical-align: middle;
    }
    .orders-table th {
        text-align: left;
        background: #faf7ea;
        font-weight: 700;
    }

    .status-pill {
        border-radius: 999px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 700;
        background: #eef3ff;
        color: #28457a;
    }

    .view-btn {
        display: inline-block;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 700;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        color: #1a1a1a;
    }

    .empty-cell { text-align: center; padding: 28px; color: #666; }
    .pagination-wrap { padding: 12px 16px; }

    .floating-top-btn {
        position: fixed; right: 20px; bottom: 24px; width: 46px; height: 46px; border-radius: 50%;
        border: none; background: #0C243D; color: #fff; font-size: 22px; line-height: 1;
        box-shadow: 0 8px 20px rgba(0,0,0,.35); cursor: pointer; opacity: 0;
        transform: translateY(12px); pointer-events: none;
        transition: opacity .2s ease, transform .2s ease; z-index: 1200;
    }
    .floating-top-btn.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
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
            <div class="title-row"><h1>My Orders</h1></div>

            <div class="card-box">
                <div class="table-wrap">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td><span class="status-pill">{{ ucfirst($order->status) }}</span></td>
                                    <td>{{ $order->created_at?->format('M d, Y h:i A') }}</td>
                                    <td><a href="{{ route('orders.show', $order) }}" class="view-btn">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="empty-cell">There is none</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($orders, 'links'))
                    <div class="pagination-wrap">{{ $orders->links() }}</div>
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
</script>
@endsection
