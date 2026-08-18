@extends('layouts.app')

@section('title', '商品購入')

@section('content')
<div class="purchase">
    <form class="purchase__form" method="POST" action="{{ route('purchase.store', $item->id) }}">
        @csrf

        <div class="purchase__left">
            <div class="purchase__item">
                <div class="purchase__item-image">
                    <img
                        class="purchase__item-img"
                        src="{{ \Illuminate\Support\Str::startsWith($item->image_url, 'http') ? $item->image_url : asset('storage/' . $item->image_url) }}"
                        alt="{{ $item->name }}">
                </div>
                <div class="purchase__item-info">
                    <p class="purchase__item-name">{{ $item->name }}</p>
                    <p class="purchase__item-price">¥ {{ number_format($item->price) }}</p>
                </div>
            </div>

            <hr class="purchase__divider">

            <div class="purchase__payment">
                <h2 class="purchase__section-title">支払い方法</h2>
                {{-- TODO: PurchaseRequest実装後、支払い方法のバリデーションエラー表示を追加 --}}
                <select class="purchase__select" name="payment_method">
                    <option value="">選択してください</option>
                    <option value="convenience">コンビニ払い</option>
                    <option value="card">カード支払い</option>
                </select>
            </div>

            <hr class="purchase__divider">
            {{-- TODO: Profile情報を表示し、配送先変更後は購入用住所を反映 --}}
            <div class="purchase__shipping">
                <div class="purchase__shipping-header">
                    <h2 class="purchase__section-title">配送先</h2>
                    {{-- TODO: 配送先変更画面へ接続 --}}
                    <a class="purchase__shipping-change" href="#">変更する</a>
                </div>
                <div class="purchase__address">
                    <p class="purchase__address-postal">〒 XXX-YYYY</p>
                    <p class="purchase__address-detail">ここには住所と建物が入ります</p>
                </div>
            </div>

            <hr class="purchase__divider">
        </div>

        <div class="purchase__right">
            <div class="purchase__summary">
                <div class="purchase__summary-row">
                    <span class="purchase__summary-label">商品代金</span>
                    <span class="purchase__summary-value">¥ {{ number_format($item->price) }}</span>
                </div>
                <div class="purchase__summary-row">
                    <span class="purchase__summary-label">支払い方法</span>
                    <span class="purchase__summary-value purchase__summary-payment">
                        選択してください
                    </span>
                </div>
            </div>
            {{-- TODO: PurchaseRequest実装後、各入力項目のエラー表示を追加 --}}
            <button class="purchase__button" type="submit">購入する</button>
        </div>
    </form>
</div>
@endsection