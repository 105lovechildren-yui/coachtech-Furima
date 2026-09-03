@extends('layouts.app')

@section('title', 'メール認証')

@section('content')
<div class="auth">
    <h2 class="auth__title">メール認証誘導画面</h2>

    <div class="auth__message">
        登録していただいたメールアドレスに認証メールを送信しました。<br>
        メール認証を完了してください。
    </div>

    <button
        class="auth__button auth__button--verification"
        type="button">
        認証はこちらから
    </button>
    {{-- TODO: 認証処理および遷移先を実装 --}}

    <div class="auth__resend">
        <button
            class="auth__resend-link"
            type="button">
            認証メールを再送する
        </button>
    </div>
    {{-- TODO: 認証メール再送処理を実装 --}}
</div>
@endsection