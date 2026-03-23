<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Order Update - PokéStop Center</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Russo+One&display=swap" rel="stylesheet">
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }
		body { font-family: 'Poppins', sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; }
		.email-container { max-width: 600px; margin: 0 auto; background-color: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
		.header { background: linear-gradient(135deg, #F6CF57 0%, #e0b946 50%, #c79a2f 100%); padding: 30px 20px; text-align: center; }
		.logo { display: inline-block; margin-bottom: 15px; }
		.logo img { height: 60px; width: auto; }
		.header h1 { font-family: 'Russo One', sans-serif; color: #1a1a1a; font-size: 28px; margin-bottom: 5px; }
		.header p { color: #1a1a1a; font-size: 14px; opacity: 0.9; }
		.content { padding: 40px 30px; }
		.content h2 { font-family: 'Russo One', sans-serif; color: #3B4CCA; font-size: 24px; margin-bottom: 10px; }
		.subtitle { font-size: 15px; color: #999; margin-bottom: 25px; }
		.status-badge { display: inline-block; padding: 10px 20px; border-radius: 20px; font-weight: 700; font-size: 13px; margin: 15px 0; text-transform: uppercase; }
		.status-pending { background-color: #fff3cd; color: #856404; }
		.status-completed { background-color: #d4edda; color: #155724; }
		.status-cancelled { background-color: #f8d7da; color: #721c24; }
		.info-box { background-color: #f9f9f9; padding: 20px; border-left: 4px solid #3B4CCA; border-radius: 4px; margin: 20px 0; }
		.info-row { display: flex; justify-content: space-between; margin: 12px 0; }
		.info-label { color: #999; font-size: 13px; font-weight: 600; text-transform: uppercase; }
		.info-value { color: #333; font-weight: 600; }
		.message-box { background-color: #f0f4ff; padding: 20px; border-radius: 8px; border-left: 4px solid #3B4CCA; margin: 25px 0; color: #445; font-size: 14px; }
		.cta-button { display: inline-block; padding: 14px 32px; background: linear-gradient(135deg, #3B4CCA 0%, #2a3a9f 100%); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 20px 0; font-size: 15px; }
		.cta-button:hover { opacity: 0.9; }
		.footer { background-color: #f9f9f9; padding: 25px 30px; text-align: center; border-top: 1px solid #eee; }
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
			<p>Order Update</p>
		</div>

		<div class="content">
			<h2>Status Changed</h2>
			<p class="subtitle">Your order has been updated</p>

			<p>Hi <span class="accent">{{ $order->user->fname }}</span>,</p>

			<div class="info-box">
				<div class="info-row">
					<span class="info-label">Order Number</span>
					<span class="info-value">#{{ $order->id }}</span>
				</div>
				<div class="info-row">
					<span class="info-label">Order Date</span>
					<span class="info-value">{{ $order->created_at->format('M d, Y') }}</span>
				</div>
				<div class="info-row">
					<span class="info-label">Total Amount</span>
					<span class="info-value">₱{{ number_format($order->total_amount, 2) }}</span>
				</div>
			</div>

			<div style="text-align: center;">
				@if($order->status === 'pending')
					<div class="status-badge status-pending">⏳ Pending</div>
				@elseif($order->status === 'completed')
					<div class="status-badge status-completed">✓ Completed</div>
				@elseif($order->status === 'cancelled')
					<div class="status-badge status-cancelled">✕ Cancelled</div>
				@else
					<div class="status-badge" style="background-color: #e2e3e5; color: #383d41;">{{ ucfirst($order->status) }}</div>
				@endif
			</div>

			<div class="message-box">
				@if($order->status === 'completed')
					<strong>🎉 Order Completed!</strong><br>
					Your order has been completed and is ready! Thank you for shopping with us.
				@elseif($order->status === 'pending')
					<strong>⏳ Processing Order</strong><br>
					We're carefully preparing your items. You'll receive tracking information as soon as your order ships.
				@elseif($order->status === 'cancelled')
					<strong>✕ Order Cancelled</strong><br>
					Your order has been cancelled. If you have any questions or concerns, please contact our support team.
				@endif
			</div>

			<center>
				<a href="{{ route('orders.show', $order->id) }}" class="cta-button">View Order Details</a>
			</center>

			<p style="margin-top: 25px; padding-top: 25px; border-top: 1px solid #eee;">Need help? Our support team is here to assist you. Reply to this email or visit our contact page anytime.</p>
		</div>

		<div class="footer">
			<p><strong>PokéStop Center</strong></p>
			<p>We're here to help. Contact support@pokestop-center.com with any questions.</p>
			<p style="margin-top: 15px; color: #ccc;">© {{ now()->year }} PokéStop Center. All rights reserved.</p>
		</div>
	</div>
</body>
</html>
