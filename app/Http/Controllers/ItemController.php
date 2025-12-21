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
        $validated = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'storage' => 'required',
        'description' => 'nullable',
    ]);
    if ($request->hasFile('image_path')) {
    $path = $request->file('image_path')->store('items', 'public');
    $validated['image_path'] = $path;
}

    Item::create($validated);

        return redirect('/items')
                        ->with('success', '商品を登録しました');
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

    public function edit(Item $item) {        
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item) {
    $validated = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'storage' => 'required',
        'description' => 'nullable',
    ]);

    $item->update($validated);

    // 画像がアップロードされた時だけ更新
    if ($request->hasFile('image_path')) {
        $path = $request->file('image_path')->store('items', 'public');
        $item->image_path = $path;
        $item->save();
    }

    return redirect()->route('items.index')
                     ->with('success', '商品を更新しました');
    }

}
