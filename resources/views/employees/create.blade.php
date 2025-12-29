<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>社員登録</title>
</head>
<body>

<h1>社員登録</h1>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('users.store') }}">
    @csrf

    <div>
        <label>名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
    <label>年齢</label>
    <input type="number" name="age" min="0" max="120">
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
    <label>所属課</label>
    <select name="group_id">
        <option value="">選択してください</option>
        @foreach(\App\Models\User::GROUPS as $key => $label)
            <option value="{{ $key }}" {{ old('group_id') == $key ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>

    <div>
        <label>役職</label>

        <select name="role">
            <option value="">選択してください</option>
                @foreach(\App\Models\User::ROLES as $key => $label)
                <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>
        <div>
            <label for="sales_office">営業所</label>
            <input
                type="text"
                name="sales_office"
                id="sales_office"
                value="{{ old('sales_office') }}"
            >
        </div>
    <div>
        <label>パスワード</label><br>
        <input type="password" name="password">
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