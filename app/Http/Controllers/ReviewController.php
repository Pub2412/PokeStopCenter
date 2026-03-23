<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * List all reviews (Admin datatable) - MP4
     */
    public function adminIndex()
    {
        $reviews = ProductReview::with(['product', 'user'])->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Store review (MP4 - 8/10pts: post review after purchase)
     */
    public function store(StoreReviewRequest $request, Product $product)
    {
        // Check if user has purchased this product
        $hasPurchased = auth()->user()->orders()
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        if (!$hasPurchased) {
            return back()->withErrors(['message' => 'Only customers who bought this product can review it']);
        }

        // Check if already reviewed
        $existingReview = ProductReview::where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingReview) {
            return back()->withErrors(['message' => 'You have already reviewed this product']);
        }

        $validated = $request->validated();

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        if (mb_strlen(trim((string) $validated['comment'])) < 10) {
            return back()->with([
                'success' => 'Review posted successfully!',
                'warning' => 'Your comment is less than 10 characters. Consider adding more details.',
            ]);
        }

        return back()->with(['success' => 'Review posted successfully!']);
    }

    /**
     * Update review (MP4 - 10pts: edit and update review)
     */
    public function update(Request $request, ProductReview $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update($validated);

        if (mb_strlen(trim((string) $validated['comment'])) < 10) {
            return back()->with([
                'success' => 'Review updated successfully!',
                'warning' => 'Your comment is less than 10 characters. Consider adding more details.',
            ]);
        }

        return back()->with(['success' => 'Review updated successfully!']);
    }

    /**
     * Delete review (user) - MP4
     */
    public function destroy(ProductReview $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $review->delete();
        return back()->with(['success' => 'Review deleted!']);
    }

    /**
     * Admin delete review (MP4 - 5pts: admin can delete reviews)
     */
    public function adminDestroy(ProductReview $review)
    {
        $review->delete();
        return back()->with(['success' => 'Review deleted!']);
    }
}

