<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー一覧</title>
</head>

<body>
    <h2>{{ $item->name }}</h2>

    @if ($item->image_path)
    <img src="{{ asset('storage/' . $item->image_path) }}" height="150">
    @endif

    <p>{{ $item->description }}</p>

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

    <h3>レビュー一覧</h3>
    @forelse ($item->reviews as $review)
    <p>
        ★ {{ $review->rating }}
        （{{ $review->user->name ?? '匿名' }}）<br>
        {{ $review->review }}
    </p>
    <hr>
    @empty
    <p>レビューはまだありません</p>
    @endforelse

    <p>
        <a href="{{ route('items.reviews.index', $item->id) }}">
            レビューを書く
        </a>
    </p>

    <p>
        <a href="{{ route('items.index') }}">
            商品一覧へ戻る
        </a>
    </p>

</body>

</html>