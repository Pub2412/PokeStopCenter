@extends('layouts.app')

@section('title', 'Login')

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Russo+One&display=swap" rel="stylesheet">
<style>
    body > nav.navbar,
    body > footer.mt-5,
    body > .container.mt-3 {
        display: none;
    }

    body {
        background-color: transparent;
        margin: 0;
    }

    .login-template-wrap,
    .login-template-wrap * {
        box-sizing: border-box;
    }

    .login-template-wrap {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(160deg, #fff7cc 0%, #ffe27f 50%, #f4c74d 100%);
        width: 100vw;
        margin-left: calc(50% - 50vw);
        margin-right: calc(50% - 50vw);
        min-height: 100dvh;
        padding: 16px 12px 84px;
        display: flex;
        flex-direction: column;
    }

    .login-template-safe {
        width: 100%;
        max-width: 980px;
        margin: 0 auto;
        padding: 0 12px;
    }

    .login-template-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .login-template-logo {
        height: 56px;
        width: auto;
        display: block;
    }

    .login-template-title {
        font-size: 52px;
        font-family: 'Russo One', sans-serif;
        font-weight: 400;
        color: #1a1a1a;
        letter-spacing: -1px;
        line-height: 1;
    }

    .login-template-main {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px 0;
    }

    .login-template-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.10), 0 4px 12px rgba(0, 0, 0, 0.06);
        display: grid;
        grid-template-columns: auto 1fr;
        overflow: hidden;
        width: 100%;
        max-width: 740px;
        min-height: 390px;
    }

    .login-template-image-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 28px 24px;
    }

    .login-template-image-wrap {
        width: 200px;
        height: 260px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-template-image-wrap img {
        display: block;
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .login-template-greeting {
        margin-top: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #daa520;
        text-align: center;
        white-space: nowrap;
    }

    .login-template-form-col {
        padding: 44px 40px 44px 24px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-template-form-group {
        margin-bottom: 18px;
    }

    .login-template-form-group label {
        display: block;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 6px;
        color: #1a1a1a;
    }

    .login-template-input {
        font-family: 'Poppins', sans-serif;
        width: 100%;
        padding: 12px 14px;
        font-size: 15px;
        border: 1.5px solid #b5b5b5;
        border-radius: 8px;
        outline: none;
        background: #fff;
        transition: border-color 0.15s ease;
    }

    .login-template-input:focus {
        border-color: #daa520;
    }

    .login-template-input.is-invalid {
        border-color: #dc3545;
    }

    .login-template-invalid {
        margin-top: 6px;
        color: #dc3545;
        font-size: 0.875rem;
    }

    .login-template-alert {
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 14px;
        border: 1px solid transparent;
    }

    .login-template-alert-info {
        background: #e7f3ff;
        color: #0b4e90;
        border-color: #b8dcff;
    }

    .login-template-alert-success {
        background: #e9f8ee;
        color: #166534;
        border-color: #b9e9c9;
    }

    .login-template-alert-warning {
        background: #fff8e5;
        color: #92400e;
        border-color: #f3dc9d;
    }

    .login-template-forgot {
        display: block;
        text-align: right;
        margin-bottom: 18px;
        font-size: 15px;
    }

    .login-template-forgot a {
        color: #1a5ecf;
        text-decoration: none;
        font-weight: 500;
    }

    .login-template-forgot a:hover {
        text-decoration: underline;
    }

    .login-template-btn {
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

    .login-template-btn:hover {
        filter: brightness(0.95);
    }

    .login-template-btn-login {
        background: #daa520;
        color: #1a1a1a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.12);
        margin-bottom: 14px;
    }

    .login-template-btn-register {
        background: #f5e9a2;
        color: #1a1a1a;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .login-template-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #ffffff;
        font-weight: 500;
        padding-top: 0;
    }

    .login-template-footer a {
        color: #ffffff;
        text-decoration: none;
    }

    .login-template-footer a:hover {
        text-decoration: underline;
    }

    .login-template-page-footer {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        padding: 10px 0;
        background: #0C243D;
        backdrop-filter: blur(2px);
        z-index: 20;
    }

    @media (max-width: 768px) {
        .login-template-card {
            grid-template-columns: 1fr;
            max-width: 420px;
        }

        .login-template-image-col {
            padding: 28px 28px 12px;
        }

        .login-template-image-wrap {
            width: 160px;
            height: 200px;
        }

        .login-template-form-col {
            padding: 24px 28px 32px;
        }

        .login-template-title {
            font-size: 36px;
        }
    }

    @media (max-width: 420px) {
        .login-template-form-col {
            padding: 20px 18px 28px;
        }

        .login-template-logo {
            height: 40px;
        }

        .login-template-title {
            font-size: 28px;
        }

        .login-template-footer {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="login-template-wrap">
    <header>
        <div class="login-template-safe">
            <div class="login-template-header">
                <a href="{{ route('shop.index') }}">
                    <img class="login-template-logo" src="{{ asset('template/login/headerlogo.png') }}" alt="PokeStop logo">
                </a>
                <span class="login-template-title">Log-In</span>
            </div>
        </div>
    </header>

    <main class="login-template-main">
        <div class="login-template-safe" style="display:flex;justify-content:center;">
            <article class="login-template-card">
                <div class="login-template-image-col">
                    <div class="login-template-image-wrap">
                        <img src="{{ asset('template/login/loginpageimage.gif') }}" alt="Welcome image">
                    </div>
                    <p class="login-template-greeting">Nice to meet you again!</p>
                </div>

                <div class="login-template-form-col">
                    <form action="{{ route('auth.login.post') }}" method="POST" autocomplete="on">
                        @csrf

                        @if(session('verification_notice'))
                            <div class="login-template-alert login-template-alert-success">
                                {{ session('verification_notice') }}
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="login-template-alert login-template-alert-info">
                                {{ session('info') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="login-template-alert login-template-alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('warning'))
                            <div class="login-template-alert login-template-alert-warning">
                                {{ session('warning') }}
                            </div>
                        @endif

                        <div class="login-template-form-group">
                            <label for="email">Email address</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="login-template-input @error('email') is-invalid @enderror"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                            >
                            @error('email')
                                <div class="login-template-invalid">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="login-template-form-group">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="login-template-input @error('password') is-invalid @enderror"
                                required
                                autocomplete="current-password"
                            >
                            @error('password')
                                <div class="login-template-invalid">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="login-template-forgot">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            @else
                                <!-- <a href="{{ route('auth.register') }}">Create an account</a> -->
                            @endif
                        </div>

                        <button type="submit" class="login-template-btn login-template-btn-login">Log In</button>
                        <a href="{{ route('auth.register') }}" class="login-template-btn login-template-btn-register">Create new Account</a>
                    </form>
                </div>
            </article>
        </div>
    </main>

    <footer class="login-template-page-footer">
        <div class="login-template-safe">
            <div class="login-template-footer">
                <span>© 2026 PokeStop Center Management</span>
                <a href="#">Help and Support</a>
            </div>
        </div>
    </footer>
</div>
@endsection
