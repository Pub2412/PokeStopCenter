<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Trading Cards
        Product::create([
            'category_id' => 1,
            'name' => 'Pikachu Base Set Booster Pack',
            'description' => 'Classic Pokemon trading card booster pack featuring Pikachu',
            'price' => 49.99,
            'stock' => 50,
            'brand' => 'Pokemon',
            'type' => 'Booster Pack',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Charizard Collection Box',
            'description' => 'Premium collection box with Charizard promo card and booster packs',
            'price' => 79.99,
            'stock' => 30,
            'brand' => 'Pokemon',
            'type' => 'Collection Box',
            'is_active' => true,
        ]);

        // Plushies
        Product::create([
            'category_id' => 2,
            'name' => 'Pikachu 10-inch Plush',
            'description' => 'Soft and cuddly Pikachu plush toy',
            'price' => 19.99,
            'stock' => 100,
            'brand' => 'Pokemon Centre',
            'type' => 'Plush Toy',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => 2,
            'name' => 'Eevee Evolution Set (5 Plushes)',
            'description' => 'Set of 5 soft Eevee evolution plushes',
            'price' => 59.99,
            'stock' => 25,
            'brand' => 'Pokemon Centre',
            'type' => 'Plush Set',
            'is_active' => true,
        ]);

        // Figures
        Product::create([
            'category_id' => 3,
            'name' => 'Pokemon Master Figure Set',
            'description' => 'Collectible action figures of 6 legendary Pokemon',
            'price' => 39.99,
            'stock' => 40,
            'brand' => 'Bandai',
            'type' => 'Figure Set',
            'is_active' => true,
        ]);

        // Apparel
        Product::create([
            'category_id' => 4,
            'name' => 'Pokemon Trainer Hat',
            'description' => 'Official Pokemon Trainer baseball cap',
            'price' => 24.99,
            'stock' => 60,
            'brand' => 'Pokemon',
            'type' => 'Hat',
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => 4,
            'name' => 'Pikachu T-Shirt (L)',
            'description' => 'Comfortable cotton t-shirt with Pikachu graphic',
            'price' => 29.99,
            'stock' => 80,
            'brand' => 'Pokemon',
            'type' => 'T-Shirt',
            'is_active' => true,
        ]);

        // Games
        Product::create([
            'category_id' => 5,
            'name' => 'Pokemon Scarlet (Nintendo Switch)',
            'description' => 'Latest Pokemon game for Nintendo Switch',
            'price' => 59.99,
            'stock' => 20,
            'brand' => 'Nintendo',
            'type' => 'Video Game',
            'is_active' => true,
        ]);

        // Home & Decor
        Product::create([
            'category_id' => 6,
            'name' => 'Pokemon Map Wall Poster',
            'description' => 'Large poster showing complete Gotta Catch Em All map',
            'price' => 14.99,
            'stock' => 150,
            'brand' => 'Pokemon',
            'type' => 'Poster',
            'is_active' => true,
        ]);
    }
}

