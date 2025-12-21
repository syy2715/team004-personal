@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            <!-- ダッシュボード -->
            <div class="card mb-3">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>

            <!-- 操作メニュー -->
            <div class="card mb-3">
                <div class="card-header">操作メニュー</div>
                <div class="card-body">
                    <a href="{{ route('items.index') }}" class="btn btn-primary mb-2">商品一覧</a>
                    <a href="{{ route('items.create') }}" class="btn btn-success mb-2">新規商品登録</a>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary mb-2">出退勤一覧</a>
                    <a href="{{ route('attendances.create') }}" class="btn btn-info mb-2">出退勤登録</a>
                    <a href="{{ route('users.index') }}" class="btn btn-info mb-2">ユーザー一覧</a>
                    <a href="{{ route('users.create') }}" class="btn btn-success mb-2">新規ユーザー登録</a>
                </div>
            </div>

            <!-- ログアウトボタン -->
            <div class="card">
                <div class="card-header">ログアウト</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            ログアウト
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
