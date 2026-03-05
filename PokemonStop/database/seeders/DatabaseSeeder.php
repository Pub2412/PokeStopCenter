<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create an administrator account
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // create some normal customers
        User::factory(10)->create();

        // seed categories, products, and images via their factories (to be defined)
        \App\Models\Category::factory(5)->create()->each(function ($category) {
            \App\Models\Product::factory(10)->create(['category_id' => $category->id])
                ->each(function ($product) {
                    \App\Models\ProductImage::factory(2)->create(['product_id' => $product->id]);
                });
        });

        // reviews and transactions can be seeded similarly
        \App\Models\Review::factory(50)->create();
        \App\Models\Transaction::factory(20)->create()->each(function ($transaction) {
            \App\Models\TransactionItem::factory(3)->create(['transaction_id' => $transaction->id]);
        });
    }
}
