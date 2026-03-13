<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Login') }}</title>

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
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
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
      font-size: 52px;
      font-family: 'Russo One', sans-serif;
      font-weight: 400;
      color: #1a1a1a;
      letter-spacing: -1px;
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

    /* ── Login card ── */
    .login-card {
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
      padding: 32px 28px 24px;
    }

    .card-image-wrapper {
      width: 200px;
      height: 260px;
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

    .card-image-greeting {
      margin-top: 12px;
      font-size: 16px;
      font-weight: 700;
      color: #daa520;
      text-align: center;
      white-space: nowrap;
    }

    /* ── Card — right form column ── */
    .card-form {
      padding: 44px 40px 44px 24px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    /* ── Session status ── */
    .session-status {
      margin-bottom: 16px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      color: #16a34a;
      text-align: center;
    }

    /* ── Form elements ── */
    .form-group {
      margin-bottom: 18px;
    }

    .form-group label {
      display: block;
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 6px;
    }

    .form-group input {
      font-family: 'Poppins', sans-serif;
      width: 100%;
      padding: 12px 14px;
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

    /* ── Validation errors ── */
    .input-error {
      color: #dc2626;
      font-size: 13px;
      margin-top: 6px;
    }

    /* ── Remember me ── */
    .remember-row {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .remember-row input[type="checkbox"] {
      width: 16px;
      height: 16px;
      margin-right: 8px;
      accent-color: #daa520;
      cursor: pointer;
    }

    .remember-row label {
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
    }

    /* ── Forgot-password link ── */
    .forgot-link {
      display: block;
      text-align: right;
      margin-bottom: 26px;
      font-size: 15px;
    }

    .forgot-link a {
      color: #1a5ecf;
      text-decoration: none;
      font-weight: 500;
    }

    .forgot-link a:hover {
      text-decoration: underline;
    }

    /* ── Shared button base ── */
    .btn {
      font-family: 'Poppins', sans-serif;
      display: block;
      width: 100%;
      padding: 14px 0;
      font-size: 16px;
      font-weight: 700;
      border: none;
      border-radius: 999px;
      cursor: pointer;
      text-align: center;
      transition: filter 0.15s ease;
      text-decoration: none;
    }

    .btn:hover {
      filter: brightness(0.95);
    }

    /* Log In */
    .btn-login {
      background: #daa520;
      color: #1a1a1a;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
      margin-bottom: 14px;
    }

    /* Create new Account */
    .btn-register {
      background: #f5e9a2;
      color: #1a1a1a;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    /* ── Footer ── */
    footer {
      width: 100%;
      padding-bottom: 20px;
    }

    .footer-inner {
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: space-between;
      align-items: center;
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
      .login-card {
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
        font-size: 36px;
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
        font-size: 28px;
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
        <span class="header-title">Log-In</span>
      </div>
    </div>
  </header>

  <!-- Main — centred login card -->
  <main>
    <div class="safe-area" style="display:flex;justify-content:center;">
      <article class="login-card">

        <!-- Left: feature image + greeting -->
        <div class="card-image">
          <div class="card-image-wrapper">
            <img src="{{ asset('loginpageimage.gif') }}" alt="Welcome image">
          </div>
          <p class="card-image-greeting">Nice to meet you again!</p>
        </div>

        <!-- Right: login form -->
        <div class="card-form">

          <!-- Session Status -->
          @if (session('status'))
            <div class="session-status">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}" autocomplete="on">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email"
                     id="email"
                     name="email"
                     value="{{ old('email') }}"
                     required
                     autofocus
                     autocomplete="username">
              @error('email')
                <p class="input-error">{{ $message }}</p>
              @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password"
                     id="password"
                     name="password"
                     required
                     autocomplete="current-password">
              @error('password')
                <p class="input-error">{{ $message }}</p>
              @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-row">
              <input id="remember_me" type="checkbox" name="remember">
              <label for="remember_me">Remember me</label>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
              <div class="forgot-link">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
              </div>
            @endif

            <!-- Buttons -->
            <button type="submit" class="btn btn-login">Log In</button>

            @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn btn-register">Create new Account</a>
            @endif

          </form>
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