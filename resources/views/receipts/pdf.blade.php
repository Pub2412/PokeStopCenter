<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Receipt #{{ $order->id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', Arial, sans-serif;
            color: #333;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .receipt {
            background-color: white;
            padding: 50px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            max-width: 900px;
            margin: 0 auto;
        }
        .receipt-header {
            background: linear-gradient(135deg, #F6CF57 0%, #e0b946 50%, #c79a2f 100%);
            padding: 40px 30px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }
        .receipt-header::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 8px;
            background: linear-gradient(90deg, transparent, #3B4CCA 50%, transparent);
            border-radius: 0 0 8px 8px;
        }
        .header-content {
            position: relative;
            z-index: 1;
        }
        .logo-section {
            margin-bottom: 15px;
        }
        .logo-section img {
            height: 70px;
            width: auto;
            display: inline-block;
        }
        .header-title {
            font-family: 'Russo One', Arial, sans-serif;
            font-size: 36px;
            color: #1a1a1a;
            margin: 10px 0 5px 0;
            font-weight: 900;
        }
        .header-subtitle {
            font-size: 14px;
            color: #1a1a1a;
            opacity: 0.9;
            font-weight: 500;
        }
        .receipt-number {
            display: inline-block;
            background-color: rgba(255,255,255,0.3);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-top: 10px;
            color: #1a1a1a;
        }
        .order-info {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
        }
        .info-block {
            flex: 1;
        }
        .info-block h3 {
            font-family: 'Russo One', Arial, sans-serif;
            color: #3B4CCA;
            font-size: 13px;
            text-transform: uppercase;
            margin: 0 0 12px 0;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .info-block p {
            margin: 6px 0;
            color: #666;
            font-size: 13px;
        }
        .info-block .main-info {
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }
        .divider {
            height: 2px;
            background: linear-gradient(90deg, #F6CF57, #FFCC00, #F6CF57);
            margin: 30px 0;
        }
        .section-title {
            font-family: 'Russo One', Arial, sans-serif;
            color: #3B4CCA;
            font-size: 16px;
            margin: 25px 0 15px 0;
            font-weight: 700;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0 30px 0;
        }
        table thead {
            background: linear-gradient(135deg, #F6CF57 0%, #FFCC00 100%);
            color: #1a1a1a;
        }
        table th {
            padding: 14px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table td {
            padding: 14px 10px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }
        table tbody tr:last-child td {
            border-bottom: 3px solid #3B4CCA;
        }
        table .price-column {
            text-align: right;
        }
        table tbody tr:nth-child(even) {
            background-color: #fafafa;
        }
        .totals-section {
            background: linear-gradient(135deg, #f9f9f9 0%, #f0f4ff 100%);
            padding: 25px 20px;
            border-radius: 8px;
            border-left: 4px solid #3B4CCA;
            margin: 30px 0;
        }
        .totals {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 10px;
        }
        .totals-row {
            display: flex;
            justify-content: space-between;
            min-width: 250px;
            font-size: 13px;
            color: #666;
        }
        .totals-row .label {
            font-weight: 500;
        }
        .totals-row .value {
            text-align: right;
            font-weight: 600;
            color: #333;
        }
        .totals-row.total {
            font-size: 16px;
            color: #3B4CCA;
            padding-top: 10px;
            border-top: 2px solid #FFCC00;
            margin-top: 5px;
        }
        .totals-row.total .value {
            font-size: 20px;
            font-weight: 700;
            color: #3B4CCA;
        }
        .payment-section {
            background-color: #f0f4ff;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3B4CCA;
            margin: 25px 0;
            font-size: 13px;
        }
        .payment-section h4 {
            color: #3B4CCA;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 13px;
        }
        .payment-section p {
            margin: 6px 0;
            color: #666;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 2px solid #f0f0f0;
            color: #999;
            font-size: 12px;
        }
        .footer p {
            margin: 6px 0;
        }
        .footer .company-name {
            font-family: 'Russo One', Arial, sans-serif;
            font-size: 14px;
            color: #3B4CCA;
            font-weight: 700;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="receipt-header">
            <div class="header-content">
                <div class="logo-section">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==" alt="Logo" style="display:none;">
                    <!-- Using header logo from public folder -->
                </div>
                <h1 class="header-title">PokéStop Center</h1>
                <p class="header-subtitle">Official Order Receipt</p>
                <div class="receipt-number">Receipt #{{ $order->id }}</div>
            </div>
        </div>

        <div class="order-info">
            <div class="info-block">
                <h3>Customer</h3>
                <p class="main-info">{{ $order->user->fname }} {{ $order->user->lname }}</p>
                <p>{{ $order->user->email }}</p>
            </div>
            <div class="info-block">
                <h3>Order Details</h3>
                <p><span style="color: #999;">Order Date:</span> <span class="main-info">{{ $order->created_at->format('M d, Y') }}</span></p>
                <p><span style="color: #999;">Order Time:</span> <span class="main-info">{{ $order->created_at->format('h:i A') }}</span></p>
                <p><span style="color: #999;">Status:</span> <span class="main-info" style="color: #3B4CCA;">{{ ucfirst($order->status) }}</span></p>
            </div>
        </div>

        <div class="divider"></div>

        <h2 class="section-title">Order Items</h2>

        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th style="text-align: center;">Qty</th>
                    <th class="price-column">Unit Price</th>
                    <th class="price-column">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td class="price-column">PHP {{ number_format($item->unit_price, 2) }}</td>
                    <td class="price-column"><strong>PHP {{ number_format($item->quantity * $item->unit_price, 2) }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals-section">
            <div class="totals">
                <div class="totals-row">
                    <span class="label">Subtotal</span>
                    <span class="value">PHP {{ number_format($order->total_amount * 0.95, 2) }}</span>
                </div>
                <div class="totals-row">
                    <span class="label">Tax (5%)</span>
                    <span class="value">PHP {{ number_format($order->total_amount * 0.05, 2) }}</span>
                </div>
                <div class="totals-row total">
                    <span class="label">Total Amount</span>
                    <span class="value">PHP {{ number_format($order->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        @if($order->transaction)
        <div class="payment-section">
            <h4>Payment Information</h4>
            <p><strong>Payment Method:</strong> {{ ucwords(str_replace('_', ' ', $order->transaction->payment_method)) }}</p>
            <p><strong>Transaction ID:</strong> {{ $order->transaction->transaction_ref }}</p>
            <p><strong>Payment Status:</strong> <span style="color: #3B4CCA; font-weight: 700;">{{ ucfirst($order->transaction->status) }}</span></p>
        </div>
        @endif

        <div class="footer">
            <div class="company-name">PokéStop Center</div>
            <p>Thank you for your purchase! We appreciate your business.</p>
            <p>For questions or support, contact us at <strong>support@pokestop-center.com</strong></p>
            <p style="margin-top: 12px; color: #ccc;">© {{ now()->year }} PokéStop Center. All rights reserved.</p>
            <p style="margin-top: 8px; font-style: italic;">Receipt generated on {{ now()->format('M d, Y \\a\\t h:i A') }}</p>
        </div>
    </div>
</body>
</html>
