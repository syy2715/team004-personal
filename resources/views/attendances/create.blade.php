@extends('layouts.app')

@section('title', '出退勤登録')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0">出退勤登録</h5>
                </div>

                <div class="card-body text-center">

                    <div class="mb-3">
                        <div>社員名：{{ $user->name }}</div>
                        <div class="text-muted">
                            現在時刻：<span id="current-time">{{ now() }}</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 my-3 flex-wrap">
                        <form method="POST" action="{{ route('attendances.clockIn') }}">
                            @csrf
                            <button class="btn btn-primary">出勤</button>
                        </form>

                        <form method="POST" action="{{ route('attendances.breakStart') }}">
                            @csrf
                            <button class="btn btn-primary">休憩入り</button>
                        </form>

                        <form method="POST" action="{{ route('attendances.breakEnd') }}">
                            @csrf
                            <button class="btn btn-primary">休憩戻り</button>
                        </form>

                        <form method="POST" action="{{ route('attendances.clockOut') }}">
                            @csrf
                            <button class="btn btn-primary">退勤</button>
                        </form>
                    </div>

                    <a href="{{ route('attendances.index') }}" class="btn btn-link">
                        出退勤一覧画面へ
                    </a>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent =
            now.toLocaleString();
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>
@endsection