@extends('layouts.app')

@section('title', 'My Profile')

@section('extra-styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Russo+One&display=swap" rel="stylesheet">
<style>
    body > nav.navbar,
    body > footer.mt-5,
    body > .container.mt-3 { display: none; }

    body {
        margin: 0;
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        background: linear-gradient(160deg, #ead07b 0%, #d0a944 55%, #b48c30 100%);
        min-height: 100vh;
    }

    .page-wrap, .page-wrap * { box-sizing: border-box; }
    .page-wrap a { text-decoration: none; color: inherit; }
    .safe-area { width: 100%; max-width: 1120px; margin: 0 auto; padding: 0 28px; }

    .page-header {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(to bottom, #e0b946 62%, rgba(224, 185, 70, 0.82) 82%, rgba(224, 185, 70, 0) 100%);
        padding-bottom: 20px;
    }
    .page-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        padding: 14px 0;
    }

    .header-left, .header-right {
        flex: 1;
        display: flex;
        align-items: center;
    }
    .header-right { justify-content: flex-end; gap: 10px; }
    .logo img { height: 52px; width: auto; display: block; }

    .header-right a:first-child {
        margin-left: auto;
    }

    .pill {
        background: linear-gradient(180deg, #fdf6d8 0%, #e6d389 100%);
        border-radius: 999px;
        padding: 10px 18px;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .back-btn {
        border-radius: 999px;
        padding: 9px 14px;
        font-size: 13px;
        font-weight: 700;
        background: #f1f1f1;
        color: #333;
    }

    .content { padding: 14px 0 64px; }
    .title-row { margin-bottom: 16px; }
    .title-row h1 {
        margin: 0;
        font-family: 'Russo One', sans-serif;
        font-size: clamp(24px, 3vw, 34px);
        color: #1a1a1a;
    }

    .layout {
        display: grid;
        grid-template-columns: 1.1fr .9fr;
        gap: 14px;
    }

    .box {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,.15);
        overflow: hidden;
    }

    .box-head {
        padding: 12px 14px;
        font-weight: 700;
        border-bottom: 1px solid #ececec;
        background: #faf7ea;
    }

    .box-body { padding: 14px; }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .field { margin-bottom: 10px; }
    .field label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .field input {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 9px 10px;
        font-size: 14px;
    }

    .save-btn {
        border: none;
        border-radius: 999px;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 700;
        background: linear-gradient(180deg, #fdf6d8 0%, #f1dc6b 100%);
        color: #1a1a1a;
        cursor: pointer;
    }

    .profile-photo {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin-bottom: 12px;
        border: 3px solid #f2d56f;
    }

    .stat-row { margin-bottom: 6px; font-size: 14px; }

    .floating-top-btn {
        position: fixed; right: 20px; bottom: 24px; width: 46px; height: 46px; border-radius: 50%;
        border: none; background: #0C243D; color: #fff; font-size: 22px; line-height: 1;
        box-shadow: 0 8px 20px rgba(0,0,0,.35); cursor: pointer; opacity: 0;
        transform: translateY(12px); pointer-events: none;
        transition: opacity .2s ease, transform .2s ease; z-index: 1200;
    }
    .floating-top-btn.show { opacity: 1; transform: translateY(0); pointer-events: auto; }

    @media (max-width: 980px) {
        .layout { grid-template-columns: 1fr; }
    }

    @media (max-width: 700px) {
        .grid-3 { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-wrap" id="top">
    <header class="page-header">
        <div class="safe-area page-header-top">
            <div class="header-left">
                <a class="logo" href="{{ route('home') }}"><img src="{{ asset('template/index/headerlogo.png') }}" alt="PokeStop Center"></a>
            </div>
            <div class="header-right">
                <a href="{{ route('home') }}" class="back-btn">Go Back</a>
            </div>
        </div>
    </header>

    <main class="content">
        <div class="safe-area">
            <div class="title-row"><h1>My Profile</h1></div>

            <div class="layout">
                <div class="box">
                    <div class="box-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid-3">
                                <div class="field">
                                    <label for="lname">Last Name</label>
                                    <input id="lname" type="text" name="lname" value="{{ old('lname', $user->lname) }}" required>
                                </div>
                                <div class="field">
                                    <label for="fname">First Name</label>
                                    <input id="fname" type="text" name="fname" value="{{ old('fname', $user->fname) }}" required>
                                </div>
                                <div class="field">
                                    <label for="middle_initial">Middle Initial</label>
                                    <input id="middle_initial" type="text" name="middle_initial" maxlength="1" value="{{ old('middle_initial', $user->middle_initial) }}">
                                </div>
                            </div>

                            <div class="field">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="field">
                                <label for="profile_photo">Profile Photo</label>
                                <input id="profile_photo" type="file" name="profile_photo" accept="image/*">
                            </div>

                            <hr style="margin: 16px 0; border: none; border-top: 1px solid #ddd;">

                            <h4 style="margin-bottom: 12px; font-size: 14px; font-weight: 700; color: #1a1a1a;">Change Password (Optional)</h4>

                            <div class="field">
                                <label for="current_password">Current Password</label>
                                <input id="current_password" type="password" name="current_password" placeholder="Enter your current password">
                                @error('current_password')
                                    <span style="color: #dc3545; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="new_password">New Password</label>
                                <input id="new_password" type="password" name="new_password" placeholder="Enter new password (minimum 8 characters)">
                                @error('new_password')
                                    <span style="color: #dc3545; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input id="new_password_confirmation" type="password" name="new_password_confirmation" placeholder="Confirm new password">
                                @error('new_password_confirmation')
                                    <span style="color: #dc3545; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="save-btn" type="submit">Save Profile</button>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="box" style="margin-bottom:14px;">
                        <div class="box-head">My Info</div>
                        <div class="box-body">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" class="profile-photo" alt="Profile photo">
                            @endif
                            <div class="stat-row"><strong>Role:</strong> {{ ucfirst($user->role) }}</div>
                            <div class="stat-row"><strong>Status:</strong> {{ ucfirst($user->status) }}</div>
                            <div class="stat-row"><strong>Verified:</strong> {{ $user->email_verified_at ? 'Yes' : 'No' }}</div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-head">My Activity</div>
                        <div class="box-body">
                            <div class="stat-row"><strong>Orders:</strong> {{ $user->orders->count() }}</div>
                            <div class="stat-row"><strong>Reviews:</strong> {{ $user->reviews->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <button id="floatingTopBtn" class="floating-top-btn" type="button" aria-label="Back to top">↑</button>
</div>
@endsection

@section('extra-scripts')
<script>
    (function () {
        const topButton = document.getElementById('floatingTopBtn');
        function syncTopButton() {
            if (window.scrollY > 360) topButton.classList.add('show');
            else topButton.classList.remove('show');
        }
        window.addEventListener('scroll', syncTopButton);
        syncTopButton();
        topButton.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    })();
</script>
@endsection
