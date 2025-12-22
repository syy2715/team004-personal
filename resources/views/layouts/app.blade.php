<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- ★ ViteでCSSとJSを読み込む（これが無いとHerokuで色が出ない） --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                社員管理システム
            </a>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>
</body>
</html>
