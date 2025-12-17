<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>社員登録</title>
</head>
<body>

<h1>社員登録</h1>

<form method="POST" action="/register">
    @csrf

    <div>
        <label>名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        <label>メールアドレス</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        <label>電話番号</label><br>
        <input type="text" name="phone" value="{{ old('phone') }}">
    </div>

    <div>
        <label>パスワード</label><br>
        <input type="password" name="password">
    </div>

    <div>
        <label>パスワード（確認）</label><br>
        <input type="password" name="password_confirmation">
    </div>
    <br>
    <button type="submit">登録する</button>
</form>

@if ($errors->any())
    <ul style="color:red;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

</body>
</html>