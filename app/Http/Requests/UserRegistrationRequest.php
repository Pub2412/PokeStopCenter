<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Guest users can register
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'fname' => ['required', 'string', 'max:100', 'min:2'],
            'lname' => ['required', 'string', 'max:100', 'min:2'],
            'middle_initial' => ['nullable', 'string', 'max:1'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'terms' => ['accepted'],
        ];
    }

    /**
     * Get custom error messages
     */
    public function messages(): array
    {
        return [
            'fname.required' => 'First name is required',
            'fname.min' => 'First name must be at least 2 characters',
            'lname.required' => 'Last name is required',
            'lname.min' => 'Last name must be at least 2 characters',
            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'Password is required',
            'password.confirmed' => 'Passwords do not match',
            'password.min' => 'Password must be at least 8 characters and include letters and numbers',
            'profile_photo.image' => 'Profile photo must be an image file',
            'profile_photo.mimes' => 'Only JPEG, PNG, and GIF formats are allowed',
            'profile_photo.max' => 'Profile photo cannot exceed 2MB',
            'terms.accepted' => 'You must accept the terms and conditions',
        ];
    }
}
