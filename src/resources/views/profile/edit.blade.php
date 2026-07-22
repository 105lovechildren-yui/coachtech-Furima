@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('content')
<div class="auth">
    <h2 class="auth__title">プロフィール設定</h2>

    <form class="auth__form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="auth__form-group">
            <div class="auth__image-box">
                {{-- 現在の画像 あれば表示、なければグレーの丸を表示 --}}
                @if(optional($user->profile)->image_url)
                <img
                    class="auth__image"
                    src="{{ asset('storage/' . optional($user->profile)->image_url) }}"
                    alt="プロフィール画像">
                @else
                <div class="auth__image auth__image--empty"></div>
                @endif

                {{-- 新しく画像を選択 --}}
                <div class="auth__image-group">

                    <label class="auth__label auth__image-label" for="profile_image">画像を選択する</label>

                    <input
                        type="file"
                        id="profile_image"
                        name="profile_image"
                        hidden>

                </div>
            </div>
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="nickname">ユーザー名</label>
            <input
                class="auth__input"
                type="text"
                id="nickname"
                name="nickname"
                value="{{ old('nickname', optional($user->profile)->nickname) }}"
                autocomplete="name">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="postal_code">郵便番号</label>
            <input
                class="auth__input"
                type="text"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', optional($user->profile)->postal_code) }}"
                autocomplete="postal-code">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="address">住所</label>
            <input
                class="auth__input"
                type="text"
                id="address"
                name="address"
                value="{{ old('address', optional($user->profile)->address) }}"
                autocomplete="address-line1">
            {{-- TODO: バリデーション実装 --}}
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="building_name">建物名</label>
            <input
                class="auth__input"
                type="text"
                id="building_name"
                name="building_name"
                value="{{ old('building_name', optional($user->profile)->building_name) }}"
                autocomplete="address-line2">
            {{-- TODO: バリデーション実装 --}}
        </div>


        <button class="auth__button" type="submit">更新する</button>
    </form>

</div>
@endsection