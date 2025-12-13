<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規レビュー</title>
</head>
<body>
    <h2>新規レビュー</h2>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div>
            <label for="image_path">商品画像:</label>
            <select name="image_path" id="image_path"></select>

        </div>
        <div>
            <label for="item_id">商品名:</label>
            <select name="item_id" id="item_id" required>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="rating">評価 (1-5):</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>
        </div>
        <div>
            <label for="review">コメント:</label>
            <textarea name="review" id="review" rows="4" cols="50" required></textarea>
        </div>
        <button type="submit">レビューを投稿</button>
</body>
</html>