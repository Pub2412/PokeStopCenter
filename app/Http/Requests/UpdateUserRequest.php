<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('user');
        
        return [
            'fname' => ['required', 'string', 'max:100'],
            'lname' => ['required', 'string', 'max:100'],
            'middle_initial' => ['nullable', 'string', 'max:1'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'role' => ['required', 'in:admin,user'],
            'status' => ['in:active,inactive'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    /**
     * Get custom error messages
     */
    public function messages(): array
    {
        return [
            'fname.required' => 'First name is required',
            'lname.required' => 'Last name is required',
            'email.unique' => 'This email is already in use',
            'role.in' => 'Invalid role selected',
            'profile_photo.image' => 'Profile photo must be an image',
        ];
    }
}
