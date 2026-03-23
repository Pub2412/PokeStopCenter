<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user()->load(['orders.items.product', 'reviews.product']);
        return view('shop.profile', compact('user'));
    }

    public function update(UserProfileRequest $request)
    {
        $validated = $request->validated();

        // Handle profile photo
        if ($request->hasFile('profile_photo')) {
            $validated['profile_photo'] = $request->file('profile_photo')->store('user-images', 'public');
        }

        // Handle password change
        if ($request->filled('new_password')) {
            $validated['password'] = Hash::make($validated['new_password']);
        }

        // Remove password-related fields that shouldn't be stored as-is
        unset($validated['new_password']);
        unset($validated['current_password']);
        unset($validated['new_password_confirmation']);

        auth()->user()->update($validated);

        return redirect()->route('profile.show')->with(['success' => 'Profile updated successfully!']);
    }
}
