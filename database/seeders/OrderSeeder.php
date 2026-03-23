<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users and products
        $users = User::where('role', 'user')->get();
        $products = Product::active()->get();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('Please seed users and products first before seeding orders.');
            return;
        }

        $statuses = ['pending', 'in_transit', 'completed', 'cancelled'];
        $shippingAddresses = [
            '123 Main St, Manila, Metro Manila 1000, Philippines',
            '456 Oak Ave, Cebu, Cebu 6000, Philippines',
            '789 Pine Rd, Davao, Davao del Sur 8000, Philippines',
            '321 Elm St, Quezon City, Metro Manila 1100, Philippines',
            '654 Maple Dr, Makati, Metro Manila 1200, Philippines',
        ];

        // Create 15 sample orders
        for ($i = 0; $i < 15; $i++) {
            $user = $users->random();
            $totalAmount = 0;

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'status' => $statuses[array_rand($statuses)],
                'shipping_address' => $shippingAddresses[array_rand($shippingAddresses)],
                'total_amount' => 0, // Will update after adding items
            ]);

            // Add 1-3 items to each order
            $orderItemCount = rand(1, 3);
            for ($j = 0; $j < $orderItemCount; $j++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $unitPrice = $product->price;
                $subtotal = $quantity * $unitPrice;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);

                $totalAmount += $subtotal;
            }

            // Update order total amount
            $order->update(['total_amount' => $totalAmount]);

            // Create transaction for some orders
            if (rand(0, 1)) {
                Transaction::create([
                    'order_id' => $order->id,
                    'amount' => $totalAmount,
                    'payment_method' => collect(['credit_card', 'debit_card', 'paypal', 'bank_transfer'])->random(),
                    'status' => $order->status === 'completed' ? 'completed' : 'pending',
                    'transaction_ref' => 'TXN-' . uniqid(),
                ]);
            }
        }

        $this->command->info('OrderSeeder executed successfully. 15 orders with items and transactions created.');
    }
}
