@extends('layouts.app')

@section('content')
<h1>社員編集</h1>

<form action="{{ route('employees.update', $employee->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('employees.form')

    <button type="submit">更新</button>
</form>

<form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('削除しますか？')">
        削除
    </button>
</form>
@endsection
