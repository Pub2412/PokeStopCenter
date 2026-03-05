<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionItem>
 */
class TransactionItemFactory extends Factory
{
    public function definition(): array
    {
        $product = Product::factory()->create();
        return [
            'transaction_id' => Transaction::factory(),
            'product_id' => $product->id,
            'quantity' => fake()->numberBetween(1,5),
            'price' => $product->price,
        ];
    }
}
