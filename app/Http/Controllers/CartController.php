<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display cart
     */
    public function index()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('shop.cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product)
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login')->with(['info' => 'Please login to add items to cart']);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $existingItem = auth()->user()->cart()
            ->where('product_id', $product->id)
            ->first();

        if ($existingItem) {
            $existingItem->update(['quantity' => $existingItem->quantity + $validated['quantity']]);
        } else {
            auth()->user()->cart()->create([
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return back()->with(['success' => 'Product added to cart!']);
    }

    /**
     * Update cart item
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $this->authorize('update', $cartItem);

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $cartItem->update($validated);

        return back()->with(['success' => 'Cart updated!']);
    }

    /**
     * Remove from cart
     */
    public function remove(CartItem $cartItem)
    {
        $this->authorize('delete', $cartItem);

        $cartItem->delete();

        return back()->with(['success' => 'Item removed from cart!']);
    }

    /**
     * Show checkout form (collect address)
     */
    public function showCheckout()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with(['error' => 'Cart is empty!']);
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('shop.cart.checkout', compact('cartItems', 'total'));
    }

    /**
     * Checkout (create order with address)
     */
    public function checkout(Request $request)
    {
        $cartItems = auth()->user()->cart()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return back()->with(['error' => 'Cart is empty!']);
        }

        // Validate address
        $validated = $request->validate([
            'street_address' => 'required|string|min:5|max:255',
            'city' => 'required|string|min:2|max:100',
            'province' => 'required|string|min:2|max:100',
            'postal_code' => 'required|string|min:2|max:20',
            'country' => 'required|string|min:2|max:100',
        ]);

        // Format address
        $shippingAddress = sprintf(
            "%s, %s %s, %s, %s",
            $validated['street_address'],
            $validated['city'],
            $validated['postal_code'],
            $validated['province'],
            $validated['country']
        );

        // Calculate total
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create order with shipping address
        $order = auth()->user()->orders()->create([
            'total_amount' => $total,
            'status' => 'pending',
            'shipping_address' => $shippingAddress,
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->product->price,
            ]);
        }

        // Clear cart
        auth()->user()->cart()->delete();

        return redirect()->route('orders.show', $order)->with(['success' => 'Order created! Proceed to payment.']);
    }
}

