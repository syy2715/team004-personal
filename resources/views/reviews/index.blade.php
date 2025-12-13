<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー</title>
</head>
<body>
    <h2>レビュー</h2>
    <a href="{{ route('reviews.create') }}">新規レビュー</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>評価</th>
                <th>コメント</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->item->name }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        <a href="{{ route('reviews.edit', $review->id) }}">編集</a>
                    </td>
                    <td>
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
</body>
</html>