<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use App\Models\EmailVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect()->route(auth()->user()->role === 'admin' ? 'admin.dashboard' : 'home');
        }
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        if (!$user->email_verified_at) {
            return back()->withErrors(['email' => 'Please verify your email first']);
        }

        if ($user->status !== 'active') {
            return back()->withErrors(['email' => 'Your account is inactive']);
        }

        auth()->login($user);
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with(['success' => 'Welcome Admin!']);
        }
        
        return redirect()->route('home')->with(['success' => 'Logged in successfully!']);
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        if (auth()->check()) {
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(UserRegistrationRequest $request)
    {
        $validated = $request->validated();

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('user-images', 'public');
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';
        $validated['status'] = 'active';

        $user = User::create($validated);

        // Generate email verification token
        $token = Str::random(64);
        EmailVerification::create([
            'user_id' => $user->id,
            'token' => $token,
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        $verificationUrl = rtrim($request->root(), '/') . route('auth.verify', ['token' => $token], false);

        // Send verification email via Mailtrap
        try {
            Mail::send('emails.verify-email', [
                'user' => $user,
                'verificationUrl' => $verificationUrl,
            ], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Verify Your Email - PokeStop Center');
            });
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return redirect()->route('auth.login')->with(['info' => 'Account created! Please check your email to verify.']);
    }

    /**
     * Verify email
     */
    public function verifyEmail($token)
    {
        $verification = EmailVerification::where('token', $token)->first();

        if (!$verification || $verification->expires_at < now()) {
            return redirect()->route('auth.login')->withErrors(['Token expired or invalid']);
        }

        $user = $verification->user;
        if (!$user) {
            return redirect()->route('auth.login')->withErrors(['Account not found for this verification link']);
        }

        // Avoid mass-assignment issues; persist verification timestamp directly.
        $user->email_verified_at = now();
        $user->save();

        $verification->delete();

        // Ensure users always land on login page and can see verification notice.
        if (auth()->check()) {
            auth()->logout();
        }

        return redirect()->route('auth.login')->with([
            'success' => 'Email verified! You can now login.',
            'verification_notice' => 'Your account has been verified successfully. Please log in.',
        ]);
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->route('home')->with(['success' => 'Logged out successfully!']);
    }
}
