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

    @foreach ($employees as $employee)
    <tr>
        <td>{{ $employee->id }}</td>
        <td>{{ $employee->name }}</td>
        <td>{{ $employee->group }}</td>
        <td>{{ $employee->email }}</td>
        <td>{{ $employee->phone }}</td>
        <td>
            <a href="{{ route('employees.edit', $employee->id) }}">編集</a>

            <form action="{{ route('employees.destroy', $employee->id) }}"
                  method="POST"
                  style="display:inline;">
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
</table>
@endsection
