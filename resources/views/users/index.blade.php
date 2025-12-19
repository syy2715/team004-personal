@extends('layouts.app')

@section('content')
<h1>社員一覧</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>名前</th>
        <th>所属課</th>
        <th>メール</th>
        <th>電話番号</th>
        <th>操作</th>
    </tr>

@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->group_name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->phone ?? '未登録' }}</td>
    <td>
        <a href="{{ route('users.edit', $user->id) }}">編集</a>
        <form action="{{ route('users.destroy', $user->id) }}"
            method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('削除しますか？')">
                削除
            </button>
        </form>
    </td>
</tr>
@endforeach
