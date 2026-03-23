<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Confirmation - PokéStop Center</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Russo+One&display=swap" rel="stylesheet">
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }
		body { font-family: 'Poppins', sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; }
		.email-container { max-width: 700px; margin: 0 auto; background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
		.header { background: linear-gradient(135deg, #F6CF57 0%, #e0b946 50%, #c79a2f 100%); padding: 30px 20px; text-align: center; }
		.logo { display: inline-block; margin-bottom: 15px; }
		.logo img { height: 60px; width: auto; }
		.header h1 { font-family: 'Russo One', sans-serif; color: #1a1a1a; font-size: 28px; margin-bottom: 5px; }
		.header p { color: #1a1a1a; font-size: 14px; opacity: 0.9; }
		.content { padding: 40px 30px; }
		.content h2 { font-family: 'Russo One', sans-serif; color: #3B4CCA; font-size: 28px; margin-bottom: 10px; }
		.subtitle { font-size: 16px; color: #999; margin-bottom: 25px; }
		.order-badge { display: inline-block; background: linear-gradient(135deg, #FFCC00 0%, #FFB800 100%); color: #1a1a1a; padding: 8px 16px; border-radius: 8px; font-weight: 700; margin-bottom: 25px; }
		.order-info-row { display: flex; gap: 30px; margin-bottom: 25px; padding: 15px 0; border-bottom: 1px solid #f0f0f0; }
		.info-item { flex: 1; }
		.info-label { font-size: 12px; color: #999; text-transform: uppercase; font-weight: 600; }
		.info-value { font-size: 15px; color: #333; margin-top: 5px; font-weight: 600; }
		.items-table { width: 100%; border-collapse: collapse; margin: 30px 0; }
		.items-table thead { background-color: #F6CF57; }
		.items-table th { padding: 12px; text-align: left; font-weight: 700; color: #1a1a1a; font-size: 13px; text-transform: uppercase; }
		.items-table td { padding: 15px 12px; border-bottom: 1px solid #f0f0f0; font-size: 14px; }
		.items-table tbody tr:last-child td { border-bottom: 2px solid #3B4CCA; }
		.price-right { text-align: right; }
		.totals { margin: 30px 0; padding: 20px; background-color: #f9f9f9; border-radius: 8px; text-align: right; }
		.totals-row { margin: 10px 0; font-size: 14px; }
		.totals-row.total { font-size: 18px; font-weight: 700; color: #3B4CCA; margin-top: 15px; padding-top: 15px; border-top: 2px solid #FFCC00; }
		.cta-button { display: inline-block; padding: 14px 32px; background: linear-gradient(135deg, #3B4CCA 0%, #2a3a9f 100%); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 25px 0; font-size: 15px; }
		.cta-button:hover { opacity: 0.9; }
		.footer { background-color: #f9f9f9; padding: 30px; text-align: center; border-top: 1px solid #eee; }
		.footer p { margin: 8px 0; font-size: 13px; color: #999; }
		.accent { color: #3B4CCA; font-weight: 600; }
	</style>
</head>
<body>
	<div class="email-container">
		<div class="header">
			<div class="logo">
				<img src="{{ asset('template/index/headerlogo.png') }}" alt="PokéStop Center">
			</div>
			<h1>PokéStop Center</h1>
			<p>Thank you for your purchase!</p>
		</div>

		<div class="content">
			<h2>Order Confirmed</h2>
			<p class="subtitle">Your order has been received and is being prepared</p>

			<p>Hi <span class="accent">{{ $order->user->fname }}</span>,</p>

			<div class="order-badge">Order #{{ $order->id }}</div>

			<div class="order-info-row">
				<div class="info-item">
					<div class="info-label">Order Date</div>
					<div class="info-value">{{ $order->created_at->format('M d, Y') }}</div>
				</div>
				<div class="info-item">
					<div class="info-label">Order Time</div>
					<div class="info-value">{{ $order->created_at->format('h:i A') }}</div>
				</div>
				<div class="info-item">
					<div class="info-label">Status</div>
					<div class="info-value" style="color: #3B4CCA;">{{ ucfirst($order->status) }}</div>
				</div>
			</div>

			<h3 style="font-family: 'Russo One', sans-serif; color: #3B4CCA; margin-bottom: 15px; font-size: 18px;">Order Items</h3>

			<table class="items-table">
				<thead>
					<tr>
						<th>Product</th>
						<th style="text-align: center;">Qty</th>
						<th class="price-right">Unit Price</th>
						<th class="price-right">Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($order->items as $item)
						<tr>
							<td>{{ $item->product->name }}</td>
							<td style="text-align: center;">{{ $item->quantity }}</td>
							<td class="price-right">₱{{ number_format($item->unit_price, 2) }}</td>
							<td class="price-right"><strong>₱{{ number_format($item->quantity * $item->unit_price, 2) }}</strong></td>
						</tr>
					@endforeach
				</tbody>
			</table>

			<div class="totals">
				<div class="totals-row">Subtotal: ₱{{ number_format($order->total_amount * 0.95, 2) }}</div>
				<div class="totals-row">Tax (5%): ₱{{ number_format($order->total_amount * 0.05, 2) }}</div>
				<div class="totals-row total">Total Amount: ₱{{ number_format($order->total_amount, 2) }}</div>
			</div>

			<center>
				<a href="{{ route('orders.show', $order->id) }}" class="cta-button">Track Your Order</a>
			</center>

			<p style="margin-top: 30px; padding: 15px; background-color: #f0f4ff; border-left: 4px solid #3B4CCA; border-radius: 4px; font-size: 14px; color: #666;">
				<strong>What's next?</strong> We're preparing your items for shipment. You'll receive a tracking number and updates via email.
			</p>
		</div>

		<div class="footer">
			<p><strong>PokéStop Center</strong></p>
			<p>Thank you for shopping with us! We appreciate your business.</p>
			<p>Questions? Contact our support team at support@pokestop-center.com</p>
			<p style="margin-top: 15px; color: #ccc;">© {{ now()->year }} PokéStop Center. All rights reserved.</p>
		</div>
	</div>
</body>
</html>
