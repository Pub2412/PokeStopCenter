<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // avoid writing files during seeding; just use a placeholder path
        // ensure the public/storage/images directory exists if you later save real files
        return [
            'path' => 'images/placeholder.png',
        ];
    }
}
