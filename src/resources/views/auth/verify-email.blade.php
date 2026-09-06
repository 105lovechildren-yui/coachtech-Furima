@extends('layouts.app')

@section('title', 'メール認証')

@section('content')
<div class="auth">
    <h2 class="auth__title">メール認証誘導画面</h2>

    <div class="auth__message">
        登録していただいたメールアドレスに認証メールを送信しました。<br>
        メール認証を完了してください。
    </div>

    <a
        href="http://localhost:8025"
        class="auth__button auth__button--verification">
        認証はこちらから
    </a>


    <div class="auth__resend">
        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button
                class="auth__resend-link"
                type="submit">
                認証メールを再送する
            </button>
        </form>
    </div>
    {{-- TODO: 認証メール再送処理を実装 --}}
</div>
@endsection