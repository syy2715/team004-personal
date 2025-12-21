@extends('layouts.app')

@section('content')
<style>
    .edit-container {
        max-width: 420px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .edit-container h2 {
        text-align: center;
        margin-bottom: 10px;
    }

    .edit-date {
        text-align: center;
        margin-bottom: 25px;
        font-weight: bold;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
    }

    .form-group input[type="time"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }

    .actions {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .actions button,
    .actions a {
        flex: 1;
        padding: 12px;
        text-align: center;
        border-radius: 5px;
        text-decoration: none;
        font-size: 15px;
    }

    .btn-update {
        background: #4CAF50;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .btn-back {
        background: #ccc;
        color: #000;
    }

    .btn-update:hover {
        opacity: 0.9;
    }

    .btn-back:hover {
        background: #bbb;
    }
</style>

<div class="edit-container">
    <h2>出退勤時刻 編集</h2>

    <div class="edit-date">
        日付：{{ $attendance->work_date->format('Y-m-d') }}
    </div>

    <form method="POST" action="{{ route('attendances.update', $attendance->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>出勤時刻</label>
            <input type="time" name="clock_in"
                value="{{ optional($attendance->clock_in)->format('H:i') }}">
        </div>

        <div class="form-group">
            <label>休憩入り</label>
            <input type="time" name="break_in"
                value="{{ optional($attendance->break_in)->format('H:i') }}">
        </div>

        <div class="form-group">
            <label>休憩戻り</label>
            <input type="time" name="break_out"
                value="{{ optional($attendance->break_out)->format('H:i') }}">
        </div>

        <div class="form-group">
            <label>退勤時刻</label>
            <input type="time" name="clock_out"
                value="{{ optional($attendance->clock_out)->format('H:i') }}">
        </div>

        <div class="actions">
            <button type="submit" class="btn-update">更新</button>
            <a href="{{ route('attendances.index') }}" class="btn-back">戻る</a>
        </div>
    </form>
</div>
@endsection