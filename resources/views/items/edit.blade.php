<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品編集</title>
</head>
<body>
    <h1>商品編集画面</h1>

    <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
                <label>ID</label>
                <p><input type="text" value="{{ $item->id }}" readonly></p>

               <label>商品名</label>
                <p><input type="text" name="name" value="{{ old('name', $item->name) }}"></p>

               <label>商品画像</label>
                <p><input type="file" name="image_path"></p>

               <label>分類</label>
                <p><input type="text" name="type" value="{{ old('type', $item->type) }}"></p>

               <label>価格</label>
                <p><input type="text" name="price" value="{{ old('price', $item->price) }}"></p>
        
               <label>在庫数</label>
                <p><input type="text" name="stock" value="{{ old('stock', $item->stock) }}"></p>
    
               <label>保管場所</label>
                <p><input type="text" name="storage" value="{{ old('storage', $item->storage) }}"></p>

               <label>備考</label>
                <p><input type="text" name="description" value="{{ old('description', $item->description) }}"></p>

            <button type="submit" class="btn btn-success">更新</button>
            </form>
</body>
</html>