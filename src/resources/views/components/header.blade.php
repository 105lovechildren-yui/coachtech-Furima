<header class="header">
    <div class="header__inner">

        {{--ロゴ--}}
        <div class="header__logo">
            <a href="{{ url('/') }}" class="header__logo-link">
                <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECHヘッダーロゴ" class="header__logo-image">
            </a>
        </div>

        @auth
        {{--ログイン中の検索--}}
        <div class="header__search">
            {{-- TODO: 商品検索機能実装時にフォームを追加 --}}
            <input type="text" name="keyword" placeholder="キーワード検索" class="header__search-input" value="{{ request('keyword') }}">
        </div>

        {{--ログイン中のナビゲーション--}}
        <nav class="header__nav">
            {{-- TODO: ログアウト機能実装時にフォーム追加 --}}
            <button type="button" class="header__nav-btn">ログアウト</button>
            {{-- TODO: profileルート作成後にroute('profile')へ変更 --}}
            <a href="#" class="header__nav-btn">マイページ</a>
            <a href="#" class="header__nav-link">出 品</a>
        </nav>
        @endauth
    </div>
</header>