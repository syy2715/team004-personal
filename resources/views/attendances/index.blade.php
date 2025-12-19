<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>出退勤月別一覧</title>
</head>
<body>
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
            <td><a href="#">編集</a></td>
        </tr>
    @endforeach
    </tbody>
</table>


</body>
</html>