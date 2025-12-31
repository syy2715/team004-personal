@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- タイトル＋新規登録 --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">社員一覧</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- 共通カード --}}
    <x-app-card>

        {{-- 共通テーブル --}}
        <x-app-table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>年齢</th>
                    <th>所属課</th>
                    <th>役職</th>
                    <th>営業所</th>
                    <th>メール</th>
                    <th>電話番号</th>
                    <th style="width: 140px;">操作</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->age ?? '未登録' }}</td>
                    <td>{{ $user->group_name ?? '未登録' }}</td>
                    <td>{{ \App\Models\User::ROLES[$user->role] ?? '未登録' }}</td>
                    <td>{{ \App\Models\User::SALES_OFFICES[$user->sales_office] ?? '未登録' }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? '未登録' }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}"
                            class="btn btn-sm btn-outline-primary">
                            編集
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}"
                                method="POST"
                                class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('削除しますか？')">
                                削除
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </x-app-table>

    </x-app-card>

</div>
@endsection
