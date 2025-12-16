<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Review;
use App\Models\User;

class ItemController extends Controller
{
    public function create(Request $request)
    {
        return view('item');
    }

    public function store(Request $request)
    {
        return redirect('/item');
    }

    public function index(Request $request)
    {
        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');

        $sortable = [
            'id',
            'name',
            'price',
            'stock',
            'type',
            'storage',
            'reviews_count',
            'reviews_avg_rating',
        ];

        if (!in_array($sort, $sortable)) {
            $sort = 'id';
        }

        $items = Item::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy($sort, $direction)
            ->get();

        return view('items.index', compact('items', 'sort', 'direction'));
    }

    public function show(Item $item)
    {
        // レビューも一緒に取得
        $item->load('reviews.user');

        return view('items.show', compact('item'));
    }

    public function destroy(Item $item)
    {
        $item->delete();
        
        return redirect('/items');
    }
}
