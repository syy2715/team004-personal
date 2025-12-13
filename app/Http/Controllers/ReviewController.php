<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Review;
use App\Models\Item;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        $items = Item::all();
        return view('reviews.index', compact('reviews', 'items'));
    }

    public function create()
    {
        $items = Item::all();
        return view('reviews.create', compact('items'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_id' => 'required|exists:items,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        Review::create([
            'item_id' => $validatedData['item_id'],
            'rating'  => $validatedData['rating'],
            'review'  => $validatedData['review'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('reviews.index');
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
