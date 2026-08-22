@extends('layouts.app')

@section('title', '商品一覧')

@section('content')
<div class="item-list">

    {{-- タブナビゲーション --}}
    <nav class="item-list__tab">
        <a href="{{ url('/') }}"
            class="item-list__tab-item {{ !request('tab') ? 'item-list__tab-item--active' : '' }}">
            おすすめ
        </a>
        <a href="{{ url('/?tab=mylist') }}"
            class="item-list__tab-item {{ request('tab') === 'mylist' ? 'item-list__tab-item--active' : '' }}">
            マイリスト
        </a>
    </nav>

    {{-- 商品グリッド --}}
    <div class="item-list__grid">
        @forelse ($items as $item)
        <div class="item-list__card">
            <a href="{{ route('item.show', $item->id) }}" class="item-list__card-link">
                <div class="item-list__card-image-wrap">
                    <img
                        src="{{ \Illuminate\Support\Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}"
                        alt="{{ $item->name }}"
                        class="item-list__card-image">

                    @if ($item->purchase)
                    <span class="item-list__card-badge">Sold</span>
                    @endif
                </div>
                <p class="item-list__card-name">{{ $item->name }}</p>

            </a>
        </div>
        @empty
        <p class="item-list__empty">商品がありません</p>
        @endforelse
    </div>

</div>
@endsection