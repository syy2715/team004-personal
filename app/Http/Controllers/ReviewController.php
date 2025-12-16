<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Item;

class ReviewController extends Controller
{
    public function index(Item $item)
    {
        $reviews = $item->reviews()
            ->latest()
            ->get();

        return view('reviews.index', compact('item', 'reviews'));
    }
    
    public function store(Request $request, Item $item)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $item->reviews()->create([
            'user_id' => 1, // 仮のユーザーID
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()
            ->route('items.reviews.index', $item->id)
            ->with('success', 'レビューを投稿しました');
    }


    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    public function edit(Review $review)
    {
        $items = Item::all();
        return view('reviews.edit', compact('review', 'items'));
    }

    public function update(Request $request, Review $review)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $review->update($validatedData);

        return redirect()->route('reviews.index');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index');
    }
}
