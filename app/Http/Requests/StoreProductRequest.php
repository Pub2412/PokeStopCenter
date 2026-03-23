<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['required', 'string', 'min:10', 'max:2000'],
            'price' => ['required', 'numeric', 'min:0.01', 'max:9999.99'],
            'stock' => ['required', 'integer', 'min:0', 'max:999999'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:100'],
            'is_active' => ['boolean'],
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    /**
     * Get custom error messages
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required',
            'name.min' => 'Product name must be at least 3 characters',
            'name.max' => 'Product name cannot exceed 255 characters',
            'description.required' => 'Product description is required',
            'description.min' => 'Description must be at least 10 characters',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Price must be a valid number',
            'price.min' => 'Price must be greater than 0',
            'stock.required' => 'Stock quantity is required',
            'stock.integer' => 'Stock must be a whole number',
            'category_id.exists' => 'Selected category is invalid',
            'photos.max' => 'You can upload a maximum of 5 photos',
            'photos.*.image' => 'Each file must be an image',
            'photos.*.mimes' => 'Only JPEG, PNG, and GIF formats are allowed',
            'photos.*.max' => 'Each image must not exceed 2MB',
        ];
    }
}
