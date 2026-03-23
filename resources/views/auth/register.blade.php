@extends('layouts.app')

@section('title', 'Register')

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

    .register-template-wrap,
    .register-template-wrap * {
        box-sizing: border-box;
    }

    .register-template-wrap {
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

    .register-template-safe {
        width: 100%;
        max-width: 980px;
        margin: 0 auto;
        padding: 0 12px;
    }

    .register-template-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .register-template-logo {
        height: 56px;
        width: auto;
        display: block;
    }

    .register-template-title {
        font-size: 52px;
        font-family: 'Russo One', sans-serif;
        font-weight: 400;
        color: #1a1a1a;
        letter-spacing: -1px;
        line-height: 1;
    }

    .register-template-main {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px 0;
    }

    .register-template-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.10), 0 4px 12px rgba(0, 0, 0, 0.06);
        width: 100%;
        max-width: 760px;
        padding: 30px 30px 24px;
    }

    .register-name-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .register-form-group {
        margin-bottom: 14px;
    }

    .register-form-group label {
        display: block;
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 4px;
        color: #1a1a1a;
    }

    .register-input {
        width: 100%;
        padding: 11px 14px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        border: 1.5px solid #b5b5b5;
        border-radius: 8px;
        outline: none;
        background: #fff;
        transition: border-color 0.15s ease;
    }

    .register-input:focus {
        border-color: #daa520;
    }

    .register-input.is-invalid {
        border-color: #dc3545;
    }

    .register-invalid {
        margin-top: 6px;
        color: #dc3545;
        font-size: 0.875rem;
    }

    .register-help {
        color: #6c757d;
        font-size: 0.8rem;
        display: block;
        margin-top: 5px;
    }

    .terms-box {
        border: 1px solid #dee2e6;
        border-radius: 12px;
        background: #ffffff;
        padding: 12px 14px;
        margin-top: 10px;
        margin-bottom: 16px;
    }

    .terms-box-title {
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .terms-scroll {
        max-height: 180px;
        overflow-y: auto;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 10px;
        background: #fafafa;
        font-size: 0.85rem;
        line-height: 1.45;
        margin-bottom: 8px;
    }

    .terms-scroll p {
        margin-bottom: 0.5rem;
    }

    .register-template-btn {
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
    }

    .register-template-btn:hover {
        filter: brightness(0.95);
    }

    .register-template-btn:disabled {
        filter: grayscale(0.3);
        opacity: 0.7;
        cursor: not-allowed;
    }

    .register-back-link {
        display: block;
        text-align: center;
        margin-top: 14px;
        font-size: 15px;
    }

    .register-back-link a {
        color: #1a3c7a;
        text-decoration: none;
    }

    .register-back-link a:hover {
        text-decoration: underline;
    }

    .register-template-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        color: #ffffff;
        font-weight: 500;
    }

    .register-template-footer a {
        color: #ffffff;
        text-decoration: none;
    }

    .register-template-footer a:hover {
        text-decoration: underline;
    }

    .register-template-page-footer {
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
        .register-template-card {
            max-width: 620px;
            padding: 24px 22px 20px;
        }

        .register-template-title {
            font-size: 36px;
        }
    }

    @media (max-width: 560px) {
        .register-name-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
    }

    @media (max-width: 420px) {
        .register-template-card {
            padding: 20px 16px 18px;
        }

        .register-template-logo {
            height: 40px;
        }

        .register-template-title {
            font-size: 28px;
        }

        .register-template-footer {
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="register-template-wrap">
    <header>
        <div class="register-template-safe">
            <div class="register-template-header">
                <a href="{{ route('shop.index') }}">
                    <img class="register-template-logo" src="{{ asset('template/login/headerlogo.png') }}" alt="PokeStop logo">
                </a>
                <span class="register-template-title">Sign-Up</span>
            </div>
        </div>
    </header>

    <main class="register-template-main">
        <div class="register-template-safe" style="display:flex;justify-content:center;">
            <article class="register-template-card">
                <form id="register-form" action="{{ route('auth.register.post') }}" method="POST" enctype="multipart/form-data" autocomplete="on">
                    @csrf

                    <div class="register-name-row">
                        <div class="register-form-group">
                            <label for="fname">First Name</label>
                            <input
                                type="text"
                                class="register-input @error('fname') is-invalid @enderror"
                                id="fname"
                                name="fname"
                                value="{{ old('fname') }}"
                                required
                                autocomplete="given-name"
                            >
                            @error('fname')
                                <div class="register-invalid">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="register-form-group">
                            <label for="lname">Last Name</label>
                            <input
                                type="text"
                                class="register-input @error('lname') is-invalid @enderror"
                                id="lname"
                                name="lname"
                                value="{{ old('lname') }}"
                                required
                                autocomplete="family-name"
                            >
                            @error('lname')
                                <div class="register-invalid">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="register-form-group">
                        <label for="middle_initial">Middle Initial (Optional)</label>
                        <input
                            type="text"
                            class="register-input @error('middle_initial') is-invalid @enderror"
                            id="middle_initial"
                            name="middle_initial"
                            value="{{ old('middle_initial') }}"
                            maxlength="1"
                            autocomplete="additional-name"
                        >
                        @error('middle_initial')
                            <div class="register-invalid">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group">
                        <label for="email">Email Address</label>
                        <input
                            type="email"
                            class="register-input @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                        >
                        @error('email')
                            <div class="register-invalid">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="register-input @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            required
                            autocomplete="new-password"
                        >
                        @error('password')
                            <div class="register-invalid">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="register-form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input
                            type="password"
                            class="register-input"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    <div class="register-form-group">
                        <label for="profile_photo">Profile Photo (Optional)</label>
                        <input
                            type="file"
                            class="register-input @error('profile_photo') is-invalid @enderror"
                            id="profile_photo"
                            name="profile_photo"
                            accept="image/*"
                        >
                        <small class="register-help">Max 2MB, JPG/PNG only</small>
                        @error('profile_photo')
                            <div class="register-invalid">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="terms-box">
                        <div class="terms-box-title">PokeStop Terms and Conditions</div>
                        <div class="terms-scroll" aria-label="Terms and conditions text">
                            <p><strong>1. Account Use:</strong> You agree to provide accurate account information and keep your credentials secure.</p>
                            <p><strong>2. Orders and Payments:</strong> All purchases are subject to product availability and successful payment verification.</p>
                            <p><strong>3. Product Media:</strong> Product images are for reference only. Actual color and packaging may vary slightly.</p>
                            <p><strong>4. User Content:</strong> Reviews and comments must be respectful and must not contain harmful or abusive language.</p>
                            <p><strong>5. Privacy:</strong> PokeStop stores account and order data only for service operations, order fulfillment, and platform security.</p>
                            <p><strong>6. Policy Updates:</strong> Terms may be updated when needed. Continued use of the service means you accept updated policies.</p>
                        </div>
                        <div class="form-check mb-1">
                            <input
                                type="checkbox"
                                class="form-check-input @error('terms') is-invalid @enderror"
                                id="terms"
                                name="terms"
                                value="1"
                                @checked(old('terms'))
                                required
                            >
                            <label class="form-check-label" for="terms">
                                I have read and agree to the Terms and Conditions
                            </label>
                        </div>
                        <small class="register-help">You must accept this before creating your account.</small>
                        @error('terms')
                            <div class="register-invalid">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" id="register-submit-btn" class="register-template-btn" disabled>
                        Create Account
                    </button>

                    <div class="register-back-link">
                        Already have an account? <a href="{{ route('auth.login') }}">Login here</a>
                    </div>
                </form>
            </article>
        </div>
    </main>

    <footer class="register-template-page-footer">
        <div class="register-template-safe">
            <div class="register-template-footer">
                <span>© 2026 PokeStop Center Management</span>
                <a href="#">Help and Support</a>
            </div>
        </div>
    </footer>
</div>
@endsection

@section('extra-scripts')
<script>
    (function () {
        const form = document.querySelector('form[action="{{ route('auth.register.post') }}"]');
        if (!form) {
            return;
        }
        const terms = document.getElementById('terms');
        const submitBtn = document.getElementById('register-submit-btn');

        const syncSubmitState = () => {
            submitBtn.disabled = !terms.checked;
        };

        syncSubmitState();
        terms.addEventListener('change', syncSubmitState);
    })();
</script>
@endsection
