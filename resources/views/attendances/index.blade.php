@extends('layouts.app')

@section('content')
    <h2>出退勤一覧画面</h2>
    <a href="{{ route('attendances.create') }}">出退勤登録画面へ</a>

    <form method="GET">
        <input type="month" name="month" value="{{ $month }}">
        <button>表示</button>
    </form>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>日付</th>
                <th>出勤</th>
                <th>退勤</th>
                <th>休憩入</th>
                <th>休憩戻</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($dates as $date)
            @php
                $key = $date->format('Y-m-d');
                $attendance = $attendances[$key] ?? null;
            @endphp
            <tr>
                <td>{{ $date->format('Y-m-d') }}({{ $date->isoFormat('ddd') }})</td>
                <td>{{ $attendance?->clock_in?->format('H:i') ?? 'x' }}</td>
                <td>{{ $attendance?->clock_out?->format('H:i') ?? 'x' }}</td>
                <td>{{ $attendance?->break_in?->format('H:i') ?? '' }}</td>
                <td>{{ $attendance?->break_out?->format('H:i') ?? '' }}</td>
                @isset($attendance->id)
                    <td><a href="{{ route('attendances.edit' , $attendance->id) }}">編集</a></td>
                @endisset
            </tr>
        @endforeach
        </tbody>
    </table>


@endsection