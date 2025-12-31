@extends('layouts.app')

@section('title', '出退勤登録')

@section('content')
<style>
    /* 共通の円形ボタンスタイル */
    .btn-circle {
        width: 90px;
        /* 少し大きめ */
        height: 90px;
        padding: 0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    /* パステルカラーの別パターン */
    .btn-clockin {
        background-color: #B2DFDB;
    }

    /* ミントグリーン */
    .btn-breakstart {
        background-color: #FFE0B2;
    }

    /* パステルオレンジ */
    .btn-breakend {
        background-color: #BBDEFB;
    }

    /* パステルブルー */
    .btn-clockout {
        background-color: #F8BBD0;
    }

    /* パステルピンク */

    /* ホバーで少し拡大＋影を追加 */
    .btn-circle:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h5 class="mb-0">出退勤登録</h5>
                </div>

                <div class="card-body text-center">
                    <!-- 社員名と現在時刻 -->
                    <div class="mb-3">
                        <div>社員名：{{ $user->name }}</div>
                        <div class="text-muted">
                            現在時刻：<span id="current-time">{{ now() }}</span>
                        </div>
                    </div>

                    <!-- ボタン二段配置（別パターン） -->
                    <div class="d-flex flex-column align-items-center gap-4">

                        <!-- 1段目：休憩系 -->
                        <div class="d-flex gap-4">
                            <form method="POST" action="{{ route('attendances.clockIn') }}">
                                @csrf
                                <button class="btn btn-circle btn-clockin">出勤</button>
                            </form>

                            <form method="POST" action="{{ route('attendances.clockOut') }}">
                                @csrf
                                <button class="btn btn-circle btn-clockout">退勤</button>
                            </form>
                        </div>
                        <div class="d-flex gap-4">

                            <!-- 2段目：出勤・退勤 -->
                            <form method="POST" action="{{ route('attendances.breakStart') }}">
                                @csrf
                                <button class="btn btn-circle btn-breakstart">休憩入り</button>
                            </form>

                            <form method="POST" action="{{ route('attendances.breakEnd') }}">
                                @csrf
                                <button class="btn btn-circle btn-breakend">休憩戻り</button>
                            </form>
                        </div>

                    </div>

                    <!-- 一覧リンク -->
                    <a href="{{ route('attendances.index') }}" class="btn btn-link mt-3">
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