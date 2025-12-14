@php
function sortLink($label, $column, $sort, $direction) {
$newDirection = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
$arrow = $sort === $column ? ($direction === 'asc' ? '▲' : '▼') : '';
$url = route('items.index', ['sort' => $column, 'direction' => $newDirection]);

return "<a href='{$url}'>{$label} {$arrow}</a>";
}
@endphp


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
</head>

<body>
    <h2>商品一覧</h2>
    <a href="{{ route('items.create') }}">新規商品登録</a>

    <table border="1">
        <thead>
            <tr>
                <th>{!! sortLink('ID', 'id', $sort, $direction) !!}</th>
                <th>商品画像</th>
                <th>{!! sortLink('商品名', 'name', $sort, $direction) !!}</th>
                <th>{!! sortLink('価格', 'price', $sort, $direction) !!}</th>
                <th>{!! sortLink('分類', 'type', $sort, $direction) !!}</th>
                <th>{!! sortLink('保管場所', 'storage', $sort, $direction) !!}</th>
                <th>{!! sortLink('在庫数', 'stock', $sort, $direction) !!}</th>
                <th>{!! sortLink('評価', 'reviews_avg_rating', $sort, $direction) !!}</th>
                <th>備考</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td> <img src="{{ asset('storage/' . $item->image_path) }}" height="40"></td>
                <td>
                    <a href="{{ route('items.show', $item->id) }}">
                        {{ $item->name }}
                    </a>
                </td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->type }}</td>
                <td>{{ $item->storage }}</td>
                <td>{{ $item->stock }}</td>
                <td>
                    @if ($item->reviews_count > 0)
                    {{ number_format($item->reviews_avg_rating, 2) }}
                    ({{ $item->reviews_count }})
                    @else
                    未評価
                    @endif
                </td>
                <td>{{ $item->description }}</td>
                <td>
                    <a href="{{ route('items.edit', $item->id) }}">編集</a>
                </td>
                <td>
                    <a href="{{ route('items.reviews.index', $item->id) }}">
                        レビュー投稿
                    </a>
                </td>
                <td>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>