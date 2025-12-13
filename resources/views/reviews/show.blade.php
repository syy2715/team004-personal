<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>レビュー</title>
</head>
<body>
    <h2>レビュー</h2>
    <p>商品画像:</p>
    <p>商品名: {{ $review->item->name }}</p>
    <p>評価: {{ $review->rating }}</p>
    <p>コメント: {{ $review->review }}</p>
</body>
</html>