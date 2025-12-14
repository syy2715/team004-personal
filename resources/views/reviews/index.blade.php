<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー投稿</title>
</head>

<body>
    <p>
        <a href="{{ route('items.index') }}">
            商品一覧へ戻る
        </a>
    </p>
    <h2>{{ $item->name }} のレビュー</h2>
    @if ($item->image_path)
    <img src="{{ asset('storage/' . $item->image_path) }}" height="150">
    @endif


    <p>
        平均評価：
        @if ($item->reviews->count() > 0)
        {{ number_format($item->reviews->avg('rating'), 2) }}
        ({{ $item->reviews->count() }})
        @else
        未評価
        @endif
    </p>

    <hr>

    <h3>レビュー投稿</h3>
    <form action="{{ route('items.reviews.store', $item->id) }}" method="POST">
        @csrf
        <label>評価：</label>
        <select name="rating">
            @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <br>

        <label>コメント：</label><br>
        <textarea name="review" rows="6" cols="60"></textarea>

        <br>
        <button type="submit">投稿</button>
    </form>

    <hr>

    <h3>レビュー一覧</h3>
    @forelse ($reviews as $review)
    <p>
        ★ {{ $review->rating }}<br>
        {{ $review->review }}
    </p>
    <hr>
    @empty
    <p>レビューはまだありません</p>
    @endforelse

</body>

</html>