<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Russo+One&display=swap" rel="stylesheet">

  <style>
    /* ── Reset ── */
    *, *::before, *::after {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* ── Full-viewport gradient background ── */
    html, body {
      height: 100%;
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      color: #1a1a1a;
    }

    body {
      background: linear-gradient(180deg, #f5d6c6 0%, #f7e6a0 100%);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ── 4:3 safe-area container ── */
    .safe-area {
      width: 100%;
      max-width: calc(100vh * 4 / 3);
      margin-left: auto;
      margin-right: auto;
      padding: 0 24px;
    }

    /* ── Header ── */
    header {
      width: 100%;
      padding-top: 24px;
    }

    .header-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .header-inner a {
      display: inline-block;
    }

    .header-inner img {
      height: 56px;
      width: auto;
      display: block;
    }

    .header-title {
      font-family: 'Russo One', sans-serif;
      font-size: 52px;
      font-weight: 400;
      color: #1a1a1a;
      letter-spacing: -0.5px;
      line-height: 1;
    }

    /* ── Main — centres the card ── */
    main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      padding: 24px 0;
    }

    /* ── Card ── */
    .card {
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.10), 0 4px 12px rgba(0, 0, 0, 0.06);
      display: grid;
      grid-template-columns: auto 1fr;
      overflow: hidden;
      width: 100%;
      max-width: 720px;
      min-height: 380px;
    }

    /* ── Card — left image column ── */
    .card-image {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 32px 28px 32px;
    }

    .card-image-wrapper {
      width: 220px;
      height: 270px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-image-wrapper img {
      display: block;
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    /* ── Card — right form column ── */
    .card-form {
      padding: 44px 40px 44px 24px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* ── Form elements ── */
    .form-group {
      margin-bottom: 22px;
    }

    .form-group label {
      display: block;
      font-family: 'Poppins', sans-serif;
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 6px;
    }

    .form-group input {
      width: 100%;
      padding: 12px 14px;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      border: 1.5px solid #b5b5b5;
      border-radius: 8px;
      outline: none;
      background: #fff;
      -webkit-appearance: none;
      appearance: none;
      transition: border-color 0.15s ease;
    }

    .form-group input:focus {
      border-color: #daa520;
    }

    /* ── Validation error ── */
    .error-text {
      font-family: 'Poppins', sans-serif;
      font-size: 13px;
      color: #dc2626;
      margin-top: 6px;
    }

    /* ── Session status ── */
    .status-text {
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      color: #16a34a;
      margin-bottom: 16px;
      text-align: center;
    }

    /* ── Proceed button ── */
    .btn-proceed {
      display: block;
      width: 100%;
      padding: 14px 0;
      font-family: 'Poppins', sans-serif;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 999px;
      cursor: pointer;
      text-align: center;
      background: #daa520;
      color: #1a1a1a;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
      transition: filter 0.15s ease;
      margin-bottom: 20px;
    }

    .btn-proceed:hover {
      filter: brightness(0.95);
    }

    /* ── Info paragraph ── */
    .info-text {
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 400;
      line-height: 1.6;
      text-align: center;
      color: #1a1a1a;
      margin-bottom: 24px;
    }

    /* ── Back link ── */
    .back-link {
      display: block;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      font-weight: 600;
    }

    .back-link a {
      color: #1a3c7a;
      text-decoration: none;
    }

    .back-link a:hover {
      text-decoration: underline;
    }

    /* ── Footer ── */
    footer {
      width: 100%;
      padding-bottom: 20px;
    }

    .footer-inner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      color: #1a1a1a;
      font-weight: 500;
    }

    .footer-inner a {
      color: #1a1a1a;
      text-decoration: none;
    }

    .footer-inner a:hover {
      text-decoration: underline;
    }

    /* ── Responsive ── */
    @media (max-width: 720px) {
      .card {
        grid-template-columns: 1fr;
        max-width: 420px;
      }

      .card-image {
        padding: 28px 28px 12px;
      }

      .card-image-wrapper {
        width: 160px;
        height: 200px;
      }

      .card-form {
        padding: 24px 28px 32px;
      }

      .header-title {
        font-size: 32px;
      }
    }

    @media (max-width: 420px) {
      .card-form {
        padding: 20px 18px 28px;
      }

      .header-inner img {
        height: 40px;
      }

      .header-title {
        font-size: 24px;
      }

      .footer-inner {
        flex-direction: column;
        gap: 8px;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="safe-area">
      <div class="header-inner">
        <a href="{{ url('/') }}">
          <img src="{{ asset('headerlogo.png') }}" alt="Logo">
        </a>
        <span class="header-title">Forgot Password</span>
      </div>
    </div>
  </header>

  <!-- Main — centred card -->
  <main>
    <div class="safe-area" style="display:flex;justify-content:center;">
      <article class="card">

        <!-- Left: feature image -->
        <div class="card-image">
          <div class="card-image-wrapper">
            <img src="{{ asset('forgotpasswordimage.png') }}" alt="Forgot password image">
          </div>
        </div>

        <!-- Right: form -->
        <div class="card-form">

          <!-- Session Status -->
          @if (session('status'))
            <p class="status-text">{{ session('status') }}</p>
          @endif

          <form method="POST" action="{{ route('password.email') }}" autocomplete="on">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
              <label for="email">Email address</label>
              <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="email"
              >
              @error('email')
                <p class="error-text">{{ $message }}</p>
              @enderror
            </div>

            <button type="submit" class="btn-proceed">Proceed</button>

          </form>

          <p class="info-text">
            If you forgot your password, we would send a password reset link through your inbox.
          </p>

          <div class="back-link">
            <a href="{{ route('login') }}">Back to Log In screen</a>
          </div>

        </div>
      </article>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="safe-area">
      <div class="footer-inner">
        <span>Copyright 2026 PokéStop Center Management</span>
        <a href="#">Help and Support</a>
      </div>
    </div>
  </footer>

</body>
</html>