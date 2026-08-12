<header class="header">
    <div class="header__inner">

        {{--ロゴ--}}
        <div class="header__logo">
            <a href="{{ url('/') }}" class="header__logo-link">
                <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECHヘッダーロゴ" class="header__logo-image">
            </a>
        </div>


        {{--ログイン中の検索--}}
        <div class="header__search">
            <form method="GET" action="{{ route('item.index') }}" class="header__search-form">
                <input type="text" name="keyword" placeholder="なにをお探しですか？" class="header__search-input" value="{{ request('keyword') }}">
            </form>
        </div>

        @auth
        {{--ログイン中のナビゲーション--}}
        <nav class="header__nav">
            <form class="header__logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="header__nav-btn">ログアウト</button>
            </form>


            <a href="{{ route('profile.edit') }}" class="header__nav-btn">マイページ</a>
            {{-- TODO: 出品ページ作成時にroute('item.create')へ変更 --}}
            <a href="#" class="header__nav-link">出 品</a>
        </nav>
        @endauth
    </div>
</header>