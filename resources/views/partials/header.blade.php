<header>
    <nav class="navbar">
        <div class="navbar-left">
            <a href="{{ route('home') }}" class="navbar-brand">
                勤怠管理アプリ
            </a>
        </div>

        <ul class="navbar-menu">
            <li><a href="{{ route('users.index') }}">ユーザー</a></li>
            <li><a href="{{ route('items.index') }}">商品</a></li>
            <li><a href="{{ route('attendances.create') }}">出退勤登録</a></li>
            <li><a href="{{ route('attendances.index') }}">出退勤一覧</a></li>

            @auth
            <li>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 nav-link">
                        ログアウト
                    </button>
                </form>
            </li>

            @else
            <li><a href="{{ route('login') }}">ログイン</a></li>
            @endauth
        </ul>
    </nav>
</header>