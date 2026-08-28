<header class="header">
    <div class="header__inner">

        {{--ロゴ--}}
        <div class="header__logo">
            <a href="{{ url('/') }}" class="header__logo-link">
                <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECHヘッダーロゴ" class="header__logo-image">
            </a>
        </div>


        {{--検索--}}
        @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        <div class="header__search">
            <form method="GET" action="{{ route('item.index') }}" class="header__search-form">
                <input type="text" name="keyword" placeholder="なにをお探しですか？" class="header__search-input" value="{{ request('keyword') }}">
            </form>
        </div>
        @endif

        @auth
        {{--ログイン中のナビゲーション--}}
        <nav class="header__nav">
            <form class="header__logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="header__nav-btn">ログアウト</button>
            </form>


            <a href="{{ route('profile.index') }}" class="header__nav-btn">マイページ</a>
            <a href="{{ route('item.create') }}" class="header__nav-link">出 品</a>
        </nav>
        @endauth

        @guest
        @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        <nav class="header__nav">
            <a href="{{ route('login') }}" class="header__nav-btn">ログイン</a>
            <a href="{{ route('profile.index') }}" class="header__nav-btn">マイページ</a>
            <a href="{{ route('item.create') }}" class="header__nav-link">出 品</a>
        </nav>
        @endif
        @endguest
    </div>
</header>