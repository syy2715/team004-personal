<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>社員登録</title>

    <style>
        body {
            margin: 0;
            font-family: "Segoe UI", sans-serif;
            background: linear-gradient(#f4f8ff, #ffffff);
            color: #1f3b64;
        }

        /* ヘッダー */
        header {
            background-color: #356fe8;
            color: #fff;
            padding: 16px 32px;
            font-size: 20px;
            font-weight: bold;
        }

        /* 全体レイアウト */
        .container {
            display: flex;
            justify-content: center;
            margin-top: 60px;
        }

        /* カード */
        .card {
            background: #fff;
            width: 520px;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            margin-bottom: 32px;
            font-size: 26px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
        }

        input, select {
            border: 1px solid #d9e1f2;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #356fe8;
        }

        /* サイズ調整 */
        .input-full {
            width: 100%;
        }

        .input-small {
            width: 160px;
        }

        .input-medium {
            width: 300px;
        }

        /* ボタン */
        button {
            width: 100%;
            background-color: #356fe8;
            color: #fff;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2f5fd1;
        }

        .errors {
            margin-top: 20px;
            color: #c0392b;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    社員管理システム
</header>

<div class="container">
    <div class="card">
        <h1>社員登録</h1>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="field">
                <label>名前</label>
                <input type="text" name="name" class="input-full" value="{{ old('name') }}">
            </div>

            <div class="field">
                <label>年齢</label>
                <input type="number" name="age" class="input-small" min="0" max="120">
            </div>

            <div class="field">
                <label>メールアドレス</label>
                <input type="email" name="email" class="input-full" value="{{ old('email') }}">
            </div>

            <div class="field">
                <label>電話番号</label>
                <input type="text" name="phone" class="input-medium" value="{{ old('phone') }}">
            </div>

            <div class="field">
                <label>所属課</label>
                <select name="group_id" class="input-small">
                    <option value="">選択してください</option>
                    @foreach(\App\Models\User::GROUPS as $key => $label)
                        <option value="{{ $key }}" {{ old('group_id') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>役職</label>
                <select name="role" class="input-small">
                    <option value="">選択してください</option>
                    @foreach(\App\Models\User::ROLES as $key => $label)
                        <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>営業所</label>
                    <select name="sales_office" class="input-small">
                    <option value="">選択してください</option>
                @foreach(\App\Models\User::SALES_OFFICES as $key => $label)
                    <option value="{{ $key }}" {{ old('sales_office') == $key ? 'selected' : '' }}>
                    {{ $label }}
                    </option>
                @endforeach
                    </select>
            </div>

            <div class="field">
                <label>パスワード</label>
                <input type="password" name="password" class="input-full">
            </div>

            <button type="submit">登録する</button>
        </form>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

</body>
</html>