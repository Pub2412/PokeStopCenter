<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;

class UserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'fname' => ['required', 'string', 'max:100', 'min:2'],
            'lname' => ['required', 'string', 'max:100', 'min:2'],
            'middle_initial' => ['nullable', 'string', 'max:1'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed', 'different:current_password'],
            'new_password_confirmation' => ['nullable', 'required_with:new_password'],
        ];
    }

    public function messages(): array
    {
        return [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email address.',
            'email.unique' => 'This email is already in use.',
            'profile_photo.image' => 'Profile photo must be an image file.',
            'profile_photo.max' => 'Profile photo cannot exceed 2MB.',
            'current_password.required_with' => 'Current password is required to set a new password.',
            'current_password.current_password' => 'The current password is incorrect.',
            'new_password.required_with' => 'New password is required when changing password.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
            'new_password.different' => 'New password must be different from current password.',
        ];
    }
}
