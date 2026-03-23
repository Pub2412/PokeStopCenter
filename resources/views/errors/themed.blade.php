@extends('layouts.app')

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&family=Russo+One&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(160deg, #fff7cc 0%, #ffe27f 50%, #f4c74d 100%);
        min-height: 100vh;
    }

    /* Error pages: show only logo in the header */
    .navbar .navbar-toggler,
    .navbar .navbar-collapse {
        display: none !important;
    }

    .navbar .container-fluid {
        justify-content: center;
    }

    .navbar-brand {
        font-size: 0 !important;
        line-height: 0;
        pointer-events: none;
    }

    .navbar-brand i {
        display: none !important;
    }

    .navbar-brand::before {
        content: '';
        display: block;
        width: 180px;
        height: 56px;
        background: url('{{ asset('template/index/headerlogo.png') }}') center center / contain no-repeat;
    }

    .error-wrap {
        padding: 42px 16px 56px;
    }

    .error-shell {
        max-width: 760px;
        margin: 0 auto;
    }

    .error-card {
        background: #fff;
        border-radius: 26px;
        padding: 34px 30px;
        text-align: center;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.14);
        border: 2px solid rgba(244, 199, 77, 0.5);
    }

    .error-image {
        width: min(220px, 62vw);
        height: auto;
        display: block;
        margin: 0 auto 10px;
    }

    .error-code {
        font-family: 'Russo One', sans-serif;
        font-size: clamp(2.1rem, 6.4vw, 3.8rem);
        color: #1a1a1a;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .error-title {
        font-size: clamp(1.35rem, 4.2vw, 2rem);
        font-weight: 800;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .error-message {
        color: #3f3f3f;
        font-size: 1.05rem;
        margin-bottom: 14px;
    }

    .error-extra {
        background: #fff7d7;
        border-radius: 14px;
        padding: 12px 14px;
        color: #403100;
        margin-bottom: 16px;
    }

    .error-actions {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .error-btn {
        border: none;
        border-radius: 999px;
        padding: 11px 18px;
        font-size: 0.95rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .error-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.16);
    }

    .error-btn-primary {
        background: linear-gradient(180deg, #fdf6d8 0%, #e8d88c 100%);
        color: #1a1a1a;
    }

    .error-btn-secondary {
        background: #1d4a79;
        color: #fff;
    }

    @media (max-width: 576px) {
        .error-card {
            border-radius: 20px;
            padding: 24px 18px;
        }
    }
</style>
@endsection

@section('content')
<div class="error-wrap">
    <div class="error-shell">
        <div class="error-card">
            <img src="{{ asset('template/forgot/forgotpasswordimage.png') }}" alt="PokeStop Error" class="error-image">
            <p class="error-code">@yield('error-code')</p>
            <h1 class="error-title">@yield('error-heading')</h1>
            <p class="error-message">@yield('error-message')</p>

            @hasSection('error-extra')
                <div class="error-extra">
                    @yield('error-extra')
                </div>
            @endif

            <div class="error-actions">
                <a href="{{ route('home') }}" class="error-btn error-btn-primary">
                    <i class="fas fa-home"></i> Return Home
                </a>
                @yield('error-actions')
            </div>
        </div>
    </div>
</div>
@endsection