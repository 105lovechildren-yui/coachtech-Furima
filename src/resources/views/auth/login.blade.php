@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="login">
    <h2 class="login__title">ログイン</h2>

    <form class="login__form" action="{{ route('login') }}" method="POST">
        @csrf

        <div class="login__form-group">
            <label class="login__label" for="email">メールアドレス</label>
            <input
                class="login__input"
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <div class="login__form-group">
            <label class="login__label" for="password">パスワード</label>
            <input
                class="login__input"
                type="password"
                id="password"
                name="password"
                autocomplete="current-password">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <button class="login__button" type="submit">ログインする</button>
    </form>

    <div class="login__register">
        <a class="login__register-link" href="{{ route('register') }}">会員登録はこちら</a>
    </div>
</div>
@endsection