<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>出退勤登録</title>
    <style>
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background: #ececec;
            color: #333;
        }

        .container {
            max-width: 380px;
            margin: 50px auto;
            background: #ffffff;
            padding: 32px;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 24px;
            font-weight: 500;
            letter-spacing: 0.05em;
        }

        .info {
            text-align: center;
            margin-bottom: 28px;
            font-size: 14px;
            color: #555;
        }

        .time {
            margin-top: 6px;
            font-size: 18px;
            font-weight: 600;
            color: #222;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 24px;
        }

        form {
            margin: 0;
        }

        button {
            width: 100%;
            padding: 14px;
            font-size: 15px;
            letter-spacing: 0.1em;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            background: #3f2fc9ff;   
            color: #ffffffff;
            transition: background 0.2s ease;
        }

        button:hover {
            background: #1e222b;
        }

        .link {
            text-align: center;
            font-size: 14px;
        }

        .link a {
            color: #555;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>出退勤登録</h2>

    <div class="info">
        <div>社員名：{{ $user->name }}</div>
        <div class="time">
            現在時刻：<span id="current-time">{{ now() }}</span>
        </div>
    </div>

    <div class="buttons">
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
    </div>

    <div class="link">
        <a href="{{ route('attendances.index') }}">出退勤一覧画面へ</a>
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

</body>
</html>
