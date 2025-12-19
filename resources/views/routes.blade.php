<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 class="text-2xl font-bold mb-4">ルート一覧</h1>

    <table class="table-auto border-collapse border border-gray-400 w-full">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 px-4 py-2">メソッド</th>
                <th class="border border-gray-400 px-4 py-2">URI</th>
                <th class="border border-gray-400 px-4 py-2">名前</th>
                <th class="border border-gray-400 px-4 py-2">リンク</th>
            </tr>
        </thead>
        <tbody>
            @foreach($routes as $route)
            <tr>
                <td class="border border-gray-400 px-4 py-2">{{ implode(', ', $route->methods()) }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $route->uri() }}</td>
                <td class="border border-gray-400 px-4 py-2">{{ $route->getName() ?? '-' }}</td>
                <td class="border border-gray-400 px-4 py-2">
                    @php
                    $url = '#';
                    if ($route->getName()) {
                    // URIにパラメータがある場合、仮の値として 1 を設定
                    $parameters = [];
                    preg_match_all('/\{([^}]+)\}/', $route->uri(), $matches);
                    foreach ($matches[1] as $param) {
                    $parameters[$param] = 1;
                    }
                    try {
                    $url = route($route->getName(), $parameters);
                    } catch (\Exception $e) {
                    $url = '#';
                    }
                    } else {
                    $url = url($route->uri());
                    }
                    @endphp
                    <a href="{{ $url }}" class="text-blue-600 hover:underline" target="_blank">開く</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>