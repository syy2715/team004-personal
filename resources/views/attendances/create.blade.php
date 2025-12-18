<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>出退勤登録</title>
</head>

<body>

    <h2>出退勤登録</h2>

    <p>社員名：{{ $employee->name }}</p>
    <p>現在時刻：{{ now() }}</p>
    <form method="POST" action="{{ route('attendances.clockIn') }}">
        @csrf
        <button>出勤</button>
    </form>

    <form method="POST" action="{{ route('attendances.breakStart') }}">
        @csrf
        <button>休憩入り</button>
    </form>

    <form method="POST" action="{{ route('attendances.breakEnd') }}">
        @csrf
        <button>休憩戻り</button>
    </form>

    <form method="POST" action="{{ route('attendances.clockOut') }}">
        @csrf
        <button>退勤</button>
    </form>

</body>

</html>