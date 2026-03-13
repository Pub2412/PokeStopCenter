<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Sign Up') }}</title>

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
      padding: 20px 0;
    }

    /* ── Card — single column, no image side ── */
    .card {
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.10), 0 4px 12px rgba(0, 0, 0, 0.06);
      width: 100%;
      max-width: 680px;
      padding: 40px 48px 36px;
    }

    /* ── Name row — two fields side by side ── */
    .name-row {
      display: flex;
      gap: 20px;
      margin-bottom: 14px;
    }

    .name-row .form-group {
      flex: 1;
      margin-bottom: 0;
    }

    /* ── Form elements ── */
    .form-group {
      margin-bottom: 14px;
    }

    .form-group label {
      display: block;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      font-weight: 700;
      margin-bottom: 4px;
    }

    .form-group input {
      width: 100%;
      padding: 11px 14px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      font-weight: 400;
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

    /* ── Proceed button ── */
    .btn-proceed {
      display: block;
      width: 60%;
      max-width: 340px;
      margin: 20px auto 16px;
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
    }

    .btn-proceed:hover {
      filter: brightness(0.95);
    }

    /* ── Back link ── */
    .back-link {
      display: block;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      font-size: 15px;
      font-weight: 400;
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
    @media (max-width: 600px) {
      .card {
        padding: 28px 24px 28px;
      }

      .name-row {
        flex-direction: column;
        gap: 14px;
      }

      .btn-proceed {
        width: 80%;
      }

      .header-title {
        font-size: 32px;
      }
    }

    @media (max-width: 420px) {
      .card {
        padding: 24px 18px 24px;
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
        <span class="header-title">Sign-Up</span>
      </div>
    </div>
  </header>

  <!-- Main — centred card -->
  <main>
    <div class="safe-area" style="display:flex;justify-content:center;">
      <article class="card">
        <form method="POST" action="{{ route('register') }}" autocomplete="on">
          @csrf

          <!-- First Name + Last Name — side by side -->
          <div class="name-row">
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text"
                     id="first_name"
                     name="first_name"
                     value="{{ old('first_name') }}"
                     required
                     autofocus
                     autocomplete="given-name">
              @error('first_name')
                <p class="input-error">{{ $message }}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text"
                     id="last_name"
                     name="last_name"
                     value="{{ old('last_name') }}"
                     required
                     autocomplete="family-name">
              @error('last_name')
                <p class="input-error">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Username -->
          <div class="form-group">
            <label for="name">Username</label>
            <input type="text"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autocomplete="username">
            @error('name')
              <p class="input-error">{{ $message }}</p>
            @enderror
          </div>

          <!-- Email Address -->
          <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email">
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
                   autocomplete="new-password">
            @error('password')
              <p class="input-error">{{ $message }}</p>
            @enderror
          </div>

          <!-- Confirm Password -->
          <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password"
                   id="password_confirmation"
                   name="password_confirmation"
                   required
                   autocomplete="new-password">
            @error('password_confirmation')
              <p class="input-error">{{ $message }}</p>
            @enderror
          </div>

          <button type="submit" class="btn-proceed">Proceed</button>

        </form>

        <div class="back-link">
          <a href="{{ route('login') }}">Back to Log In screen</a>
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