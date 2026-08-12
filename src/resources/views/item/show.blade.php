@extends('layouts.app')

@section('title', '商品詳細')

@section('content')
<div class="item-detail">

    {{-- 商品画像エリア --}}
    <div class="item-detail__image-area">

        <img class="item-detail__image" src="{{ $item->image_url }}" alt="商品画像">
    </div>

    {{-- 商品情報エリア --}}
    <div class="item-detail__info-area">

        {{-- 商品名 --}}
        <h1 class="item-detail__name">{{ $item->name }}</h1>

        {{-- ブランド名 --}}
        {{-- TODO: $item->brand_name を表示する --}}
        <p class="item-detail__brand">{{ $item->brand_name }}</p>

        {{-- 価格 --}}
        {{-- TODO: $item->price を表示する（税込み表記） --}}
        <p class="item-detail__price">¥{{ number_format($item->price) }}<span class="item-detail__price-tax">（税込）</span></p>

        {{-- いいね・コメント表示エリア --}}
        <div class="item-detail__reactions">

            {{-- TODO: いいね済みかどうかでアイコンの見た目を切り替える --}}
            <div class="item-detail__like">
                {{-- TODO: いいね・いいね解除の非同期処理を実装する --}}
                <button class="item-detail__like-btn" type="button">
                    <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="いいねアイコン">
                </button>
                <span class="item-detail__like-count">{{ $item->likes->count() }}</span>
            </div>
            <div class="item-detail__comment-count">
                <span class="item-detail__comment-icon"><img src="{{ asset('images/ふきだしロゴ.png') }}" alt="コメント"></span>
                <span class="item-detail__comment-num">{{ $item->comments->count() }}</span>
            </div>
        </div>

        {{-- 購入手続きボタン --}}
        {{-- TODO: 自分の出品商品・売却済みの場合はボタンを非表示にする --}}
        <div class="item-detail__purchase">
            <a class="item-detail__purchase-btn" href="">購入手続きへ</a>
        </div>

        {{-- 商品説明 --}}
        <section class="item-detail__description">
            <h2 class="item-detail__section-title">商品説明</h2>
            {{-- TODO: $item->description を表示する --}}
            <p class="item-detail__description-text">{{ $item->description }}</p>
        </section>

        {{-- 商品情報 --}}
        <section class="item-detail__meta">
            <h2 class="item-detail__section-title">商品の情報</h2>
            <dl class="item-detail__meta-list">
                <div class="item-detail__meta-row">
                    <dt class="item-detail__meta-label">カテゴリー</dt>
                    {{-- TODO: $item->categories を繰り返し表示する --}}
                    <dd class="item-detail__meta-value">
                        @foreach ($item->categories as $category)
                        <span class="item-detail__category-tag">{{ $category->name }}</span>
                        @endforeach
                    </dd>
                </div>
                <div class="item-detail__meta-row">
                    <dt class="item-detail__meta-label">商品の状態</dt>
                    {{-- TODO: $item->condition->name を表示する --}}
                    <dd class="item-detail__meta-value">{{ $item->condition->name }}</dd>
                </div>
            </dl>
        </section>

        {{-- コメント一覧 --}}
        <section class="item-detail__comments">
            {{-- TODO: $item->comments->count() でコメント数を表示する --}}
            <h2 class="item-detail__section-title">コメント({{ $item->comments->count() }})</h2>
            {{-- TODO: $item->comments を foreach で繰り返し表示する --}}
            @foreach ($item->comments as $comment)
            <div class="item-detail__comment">
                <div class="item-detail__comment-user">
                    {{-- TODO: ユーザーのアバター画像を表示する --}}
                    <img class="item-detail__comment-avatar" src="" alt="ユーザーアバター">
                    <span class="item-detail__comment-username">{{ $comment->user->name }}</span>
                </div>
                <p class="item-detail__comment-body">{{ $comment->comment }}</p>
            </div>
            @endforeach
        </section>

        {{-- コメント入力欄・コメント送信ボタン --}}
        <section class="item-detail__comment-form-area">
            <h2 class="item-detail__section-title">商品へのコメント</h2>
            {{-- TODO: 未ログイン時はコメントフォームを非表示にしてログインを促す --}}
            <form class="item-detail__comment-form" action="" method="POST">
                @csrf
                {{-- TODO: action に comments.store ルートを設定する --}}
                <textarea class="item-detail__comment-input" name="comment" rows="5"></textarea>
                <button class="item-detail__comment-submit" type="submit">コメントを送信する</button>
            </form>
        </section>

    </div>{{-- /.item-detail__info-area --}}

</div>{{-- /.item-detail --}}
@endsection