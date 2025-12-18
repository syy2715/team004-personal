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
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 10px;
            color: #333;
            background-color: #f9faff; /* 淡い青系背景 */
        }

        h2 {
            text-align: center;
            color: #0d3b66; /* 濃いブルー */
        }

        a.create-link {
            display: inline-block;
            margin-bottom: 15px;
            background-color: #0d3b66; /* 濃いブルー */
            color: #ffffff;
            text-decoration: none;
            padding: 8px 15px;
            border-radius: 5px;
        }

        a.create-link:hover {
            background-color: #0b3054;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 8px;
            text-align: center;
            border: 1px solid #c1d3e0; /* 淡いブルー系ボーダー */
        }

        th {
            background-color: #e6f0fa; /* 淡い青 */
            color: #0d3b66;
        }

        a {
            color: #0d3b66;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .action-buttons a,
        .action-buttons button {
            display: inline-block;
            margin: 2px;
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            color: #ffffff;
        }

        .action-buttons a.edit {
            background-color: #0d3b66;
        }

        .action-buttons a.edit:hover {
            background-color: #0b3054;
        }

        .action-buttons a.review {
            background-color: #4d79ff; /* 明るめブルーアクセント */
        }

        .action-buttons a.review:hover {
            background-color: #3b63e0;
        }

        .action-buttons button.delete {
            background-color: #c94c4c; /* 注意の赤系 */
            border: none;
        }

        .action-buttons button.delete:hover {
            background-color: #a53939;
        }

        img {
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                position: sticky;
                top: 0;
                background: #e6f0fa;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                text-align: left;
            }

            .action-buttons a, .action-buttons button {
                margin: 2px 0;
            }
        }
    </style>
</head>
<body>

<h2>商品一覧</h2>
<a class="create-link" href="{{ route('items.create') }}">新規商品登録</a>

<table>
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
            <th>操作</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($items as $item)
        <tr>
            <td data-label="ID">{{ $item->id }}</td>
            <td data-label="商品画像"><img src="{{ asset('storage/' . $item->image_path) }}" height="40"></td>
            <td data-label="商品名"><a href="{{ route('items.show', $item->id) }}">{{ $item->name }}</a></td>
            <td data-label="価格">{{ $item->price }}</td>
            <td data-label="分類">{{ $item->type }}</td>
            <td data-label="保管場所">{{ $item->storage }}</td>
            <td data-label="在庫数">{{ $item->stock }}</td>
            <td data-label="評価">
                @if ($item->reviews_count > 0)
                    {{ number_format($item->reviews_avg_rating, 2) }} ({{ $item->reviews_count }})
                @else
                    未評価
                @endif
            </td>
            <td data-label="備考">{{ $item->description }}</td>
            <td data-label="操作" class="action-buttons">
                <a class="edit" href="{{ route('items.edit', $item->id) }}">編集</a>
                <a class="review" href="{{ route('items.reviews.index', $item->id) }}">レビュー投稿</a>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
