<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * List user orders
     */
    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->paginate(10);
        return view('shop.orders.index', compact('orders'));
    }

    /**
     * Show order details
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $order->load('items.product', 'transaction');
        return view('shop.orders.show', compact('order'));
    }

    /**
     * Admin listing of all orders
     */
    public function adminIndex()
    {
        $orders = Order::with('user', 'items', 'transaction')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Process payment for order
     */
    public function pay(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Validate payment method and card details (if card payment)
        $validated = $request->validate([
            'payment_method' => 'required|in:credit_card,debit_card,paypal,bank_transfer',
            'card_number' => 'nullable|regex:/^\d{13,19}$/',
            'expiry' => 'nullable|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'nullable|regex:/^\d{3,4}$/',
        ], [
            'card_number.regex' => 'Card number must be 13-19 digits',
            'expiry.regex' => 'Expiry must be in MM/YY format',
            'cvv.regex' => 'CVV must be 3-4 digits',
        ]);

        // Require card details for card payments
        if (in_array($validated['payment_method'], ['credit_card', 'debit_card'])) {
            if (empty($validated['card_number']) || empty($validated['expiry']) || empty($validated['cvv'])) {
                return back()->withErrors(['Card details are required for card payments']);
            }
        }

        // Create transaction record WITHOUT storing card details
        // Only store payment method and transaction info
        Transaction::create([
            'order_id' => $order->id,
            'amount' => $order->total_amount,
            'payment_method' => $validated['payment_method'],
            'status' => 'completed',
            'transaction_ref' => 'TXN-' . uniqid(),
            // Card details are NOT stored here - they're only validated and discarded
        ]);

        // Mark order as in_transit after payment is processed
        $order->update(['status' => 'in_transit']);

        $order->load('items.product', 'user', 'transaction');
        $pdfContent = $this->buildReceiptPdf($order);

        // Send order confirmation email with receipt
        try {
            Mail::send('emails.order-confirmation', [
                'order' => $order,
            ], function ($message) use ($order, $pdfContent) {
                $message->to($order->user->email)
                    ->subject('Order Confirmation #' . $order->id . ' - PokeStop Center');

                if ($pdfContent !== null) {
                    $message->attachData($pdfContent, 'receipt-order-' . $order->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
                }
            });
        } catch (\Exception $e) {
            \Log::error('Order confirmation email failed: ' . $e->getMessage());
        }

        return redirect()->route('orders.show', $order)->with(['success' => 'Payment processed successfully!']);
    }

    /**
     * Admin update order status (Term Test Lab - 5pts)
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_transit,completed,cancelled',
        ]);

        $order->update($validated);

        $order->load('items.product', 'user', 'transaction');
        $pdfContent = $this->buildReceiptPdf($order);

        // Send status update email
        try {
            Mail::send('emails.order-status-update', [
                'order' => $order,
            ], function ($message) use ($order, $pdfContent) {
                $message->to($order->user->email)
                    ->subject('Order #' . $order->id . ' Status Updated - PokeStop Center');

                if ($pdfContent !== null) {
                    $message->attachData($pdfContent, 'receipt-order-' . $order->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
                }
            });
        } catch (\Exception $e) {
            \Log::error('Status update email failed: ' . $e->getMessage());
        }

        return back()->with(['success' => 'Order status updated!']);
    }

    private function buildReceiptPdf(Order $order): ?string
    {
        try {
            return Pdf::loadView('receipts.pdf', ['order' => $order])->output();
        } catch (\Exception $e) {
            \Log::warning('Receipt PDF generation failed: ' . $e->getMessage());
            return null;
        }
    }
}

