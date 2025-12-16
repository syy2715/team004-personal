<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録</title>
</head>
<body>
    <h1>商品登録画面</h1>

    <form action="{{ url('item') }}" method="POST" enctype="multipart/form-data">
@csrf
   <label for="management_number">{{ __('管理番号') }}
        <p><input type="text" class="form-control" name="management_number" id="management_number"></p>

    <label for="image_path">{{ __('商品画像') }}
        <p><input type="file" class="form-control" name="image_path" id="image_path"></p>

   <label for="item_name">{{ __('商品名') }}
        <p><input type="text" class="form-control" name="item_name" id="item_name"></p>

    <label for="type">{{ __('分類') }}
        <p><input type="text" class="form-control" name="type" id="type"></p>

    <label for="price">{{ __('価格') }}
        <p><input type="text" class="form-control" name="price" id="price"></p>
        
    <label for="stock">{{ __('在庫数') }}</label>
        <p><input type="text" class="form-control" name="stock" id="stock"></p>
    
    <label for="storage">{{ __('保管場所') }}</label>
        <p><input type="text" class="form-control" name="storage" id="storage"></p>

            <label for="storage">{{ __('備考') }}</label>
        <p><input type="text" class="form-control" name="storage" id="storage"></p>
</form>
<button type="submit" class="btn btn-success">
    {{ ('登録') }}
</button>

</body>
</html>