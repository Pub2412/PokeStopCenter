<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Email Verification - PokéStop Center</title>
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
		.content h2 { font-family: 'Russo One', sans-serif; color: #3B4CCA; font-size: 24px; margin-bottom: 20px; }
		.content p { margin-bottom: 15px; color: #555; font-size: 15px; }
		.cta-button { display: inline-block; padding: 12px 28px; background: linear-gradient(135deg, #3B4CCA 0%, #2a3a9f 100%); color: #fff; text-decoration: none; border-radius: 8px; font-weight: 600; margin: 20px 0; }
		.cta-button:hover { opacity: 0.9; }
		.footer { background-color: #f9f9f9; padding: 20px 30px; text-align: center; border-top: 1px solid #eee; font-size: 13px; color: #999; }
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
			<p>Welcome to our community!</p>
		</div>

		<div class="content">
			<h2>Verify Your Email</h2>
			<p>Hi <span class="accent">{{ $user->fname }}</span>,</p>
			<p>Thank you for signing up with PokéStop Center! To complete your registration, please verify your email address by clicking the button below:</p>

			<center>
				<a href="{{ $verificationUrl }}" class="cta-button">Verify Email Address</a>
			</center>

			<p style="margin-top: 25px; padding: 15px; background-color: #f0f4ff; border-left: 4px solid #3B4CCA; border-radius: 4px; font-size: 14px; color: #666;">
				<strong>Note:</strong> This verification link will expire in <strong>24 hours</strong>. If you didn't create this account, you can safely disregard this email.
			</p>

			<p style="margin-top: 30px;">If the button above doesn't work, copy and paste this link into your browser:<br>
			<span style="word-break: break-all; color: #3B4CCA; font-size: 12px;">{{ $verificationUrl }}</span></p>

			<p style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;"><strong>Have questions?</strong><br>Visit our help center or reply to this email.</p>
		</div>

		<div class="footer">
			<p><strong>PokéStop Center</strong></p>
			<p>© {{ now()->year }} PokéStop Center. All rights reserved.</p>
			<p>This is an automated email. Please do not reply directly to this message.</p>
		</div>
	</div>
</body>
</html>
