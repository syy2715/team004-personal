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
