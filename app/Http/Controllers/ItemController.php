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
        return view('item', [
            'type'    => Item::TYPE,
            'storage' => Item::STORAGE,
        ]);
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
        $image = $request->file('image_path');

        // MIMEタイプ取得（image/pngなど）
        $mime = $image->getMimeType();

        // base64形式でDB保存
        $validated['image_path'] =
            'data:' . $mime . ';base64,' .
            base64_encode(file_get_contents($image->getRealPath()));
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
            ->paginate(50)
            ->appends($request->query());

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

    public function edit(Item $item)
    {
        return view('items.edit', [
            'item'    => $item,
            'type'    => Item::TYPE,
            'storage' => Item::STORAGE,
        ]);
    }

    public function update(Request $request, Item $item)
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
    $image = $request->file('image_path');
    $mime = $image->getMimeType();

    $item->image_path =
        'data:' . $mime . ';base64,' .
        base64_encode(file_get_contents($image->getRealPath()));

    $item->save();
}
    //$item->update($validated);

    return redirect()->route('items.index')
        ->with('success', '商品を更新しました');
}

}
