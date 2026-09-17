@extends('layouts.app')

@section('title', 'プロフィール設定')

@section('content')
<div class="auth">
    <h2 class="auth__title auth__title--profile">プロフィール設定</h2>

    <form class="auth__form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="auth__form-group">
            <div class="auth__image-box">
                {{-- 現在の画像 あれば表示、なければグレーの丸を表示 --}}
                @if(optional($user->profile)->profile_image)
                <img
                    class="auth__image"
                    src="{{ asset('storage/' . optional($user->profile)->profile_image) }}"
                    alt="プロフィール画像">
                @else
                <div class="auth__image auth__image--empty"></div>
                @endif

                {{-- 新しく画像を選択 --}}
                <div class="auth__image-group">

                    <label class="auth__label auth__image-label auth__image-label--profile" for="profile_image">
                        画像を選択する
                    </label>

                    <input
                        type="file"
                        id="profile_image"
                        name="profile_image"
                        hidden>
                    @error('profile_image')
                    <p class="auth__error">{{ $message }}</p>
                    @enderror
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
            @error('nickname')
            <p class="auth__error">{{ $message }}</p>
            @enderror
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
            @error('postal_code')
            <p class="auth__error">{{ $message }}</p>
            @enderror
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
            @error('address')
            <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth__form-group">
            <label class="auth__label" for="building">建物名</label>
            <input
                class="auth__input"
                type="text"
                id="building"
                name="building"
                value="{{ old('building', optional($user->profile)->building) }}"
                autocomplete="address-line2">
            @error('building')
            <p class="auth__error">{{ $message }}</p>
            @enderror
        </div>


        <button class="auth__button" type="submit">更新する</button>
    </form>

</div>
@endsection