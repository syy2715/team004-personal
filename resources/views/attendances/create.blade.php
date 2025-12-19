<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>出退勤登録</title>
</head>

<body>

    <h2>出退勤登録</h2>

    <p>↓社員名は仮です 最終的にはusersテーブルを反映させます</p>
    <p>社員名：{{ $employee->name }}</p>
    <p>現在時刻：<span id="current-time">{{ now() }}</span></p>
    <script>
        function updateTime() {
            const now = new Date();
            const formatted = now.toLocaleString(); // ローカル形式で表示
            document.getElementById('current-time').textContent = formatted;
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>

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

    <p><a href="{{ route('attendances.index') }}">出退勤一覧画面</a></p>

</body>

</html>