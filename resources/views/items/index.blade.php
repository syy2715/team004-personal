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
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>分類</th>
                <th>保管場所</th>
                <th>在庫数</th>
                <th>平均評価</th>
                <th>備考</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" width="100"></td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->storage }}</td>
                    <td>{{ $item->stock }}</td>
                    <td>{{ number_format($item->average_rating, 2) }}</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}">編集</a>
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