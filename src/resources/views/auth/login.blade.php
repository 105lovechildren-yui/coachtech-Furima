@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
<div class="auth">
    <h2 class="auth__title">ログイン</h2>

    <form class="auth__form" action="{{ route('login') }}" method="POST">
        @csrf

        <div class="auth__form-group">
            <label class="auth__label" for="email">メールアドレス</label>
            <input
                class="auth__input"
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                autocomplete="email">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="password">パスワード</label>
            <input
                class="auth__input"
                type="password"
                id="password"
                name="password"
                autocomplete="current-password">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <button class="auth__button" type="submit">ログインする</button>
    </form>

    <div class="auth__register">
        <a class="auth__register-link" href="{{ route('register') }}">会員登録はこちら</a>
    </div>
</div>
@endsection