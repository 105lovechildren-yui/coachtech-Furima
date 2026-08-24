@extends('layouts.app')

@section('title', 'マイページ')

@section('content')
<div class="mypage">

    {{-- プロフィール情報 --}}
    <div class="mypage__profile">
        <div class="mypage__avatar-wrap">
            @if(optional($user->profile)->profile_image)
            <img
                src="{{ \Illuminate\Support\Str::startsWith(optional($user->profile)->profile_image, 'http') ? optional($user->profile)->profile_image : asset('storage/' . optional($user->profile)->profile_image) }}"
                alt="プロフィール画像"
                class="mypage__avatar">
            @else
            <div class="mypage__avatar mypage__avatar--empty"></div>
            @endif
        </div>

        <p class="mypage__username">{{ optional($user->profile)->nickname ?? $user->name }}</p>

        <a href="{{ route('profile.edit') }}" class="mypage__edit-btn">プロフィールを編集</a>
    </div>

    {{-- タブナビゲーション --}}
    <nav class="mypage__tab">
        <a href="{{ route('profile.index') }}" class="mypage__tab-item {{ request('page') !== 'buy' ? 'mypage__tab-item--active' : '' }}">出品した商品</a>
        <a href="{{ route('profile.index', ['page' => 'buy']) }}" class="mypage__tab-item {{ request('page') === 'buy' ? 'mypage__tab-item--active' : '' }}">購入した商品</a>
    </nav>

    {{-- 商品グリッド --}}
    <div class="mypage__grid">
        @foreach($items as $item)
        <div class="mypage__card">
            <a href="{{ route('item.show', $item->id) }}" class="mypage__card-link">
                <div class="mypage__card-image-wrap">
                    <img
                        src="{{ \Illuminate\Support\Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}"
                        alt="{{ $item->name }}"
                        class="mypage__card-image">
                </div>
                <p class="mypage__card-name">{{ $item->name }}</p>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection