@extends('layouts.app')

@section('title', '会員登録')

@section('content')
<div class="auth">
    <h2 class="auth__title">会員登録</h2>

    <form class="auth__form" action="{{ route('register') }}" method="POST">
        @csrf

        <div class="auth__form-group">
            <label class="auth__label" for="name">ユーザー名</label>
            <input
                class="auth__input"
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                autocomplete="name">
            {{-- TODO: バリデーション実装 --}}
        </div>

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
                autocomplete="new-password">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="password_confirmation">パスワード確認</label>
            <input
                class="auth__input"
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <button class="auth__button" type="submit">会員登録する</button>
    </form>

    <div class="auth__register">
        <a class="auth__register-link" href="{{ route('login') }}">ログインはこちら</a>
    </div>
</div>
@endsection