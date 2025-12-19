@extends('layouts.app')

@section('content')
<h1>社員編集</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>名前</label><br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
    </div>

    <div>
        <label>所属課</label><br>
        <select name="group_id">
                <option value="">選択してください</option>

                <option value="1" {{ old('group_id', $user->group_id) == 1 ? 'selected' : '' }}>
                    営業課
                </option>

                <option value="2" {{ old('group_id', $user->group_id) == 2 ? 'selected' : '' }}>
                    人事課
                </option>

                <option value="3" {{ old('group_id', $user->group_id) == 3 ? 'selected' : '' }}>
                    開発課
                </option>

                <option value="4" {{ old('group_id', $user->group_id) == 4 ? 'selected' : '' }}>
                    経理課
                </option>
        </select>

    </div>

    <div>
        <label>メール</label><br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
    </div>

    <div>
        <label>電話番号</label><br>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
    </div>

    <div>
        <label>パスワード（変更時のみ）</label><br>
        <input type="password" name="password">
    </div>

    <button type="submit">更新</button>
</form>
@endsection
