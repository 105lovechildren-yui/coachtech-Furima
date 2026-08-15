@extends('layouts.app')

@section('content')

{{-- ここから商品出品画面 --}}
<div class="sell">
    <h1 class="sell__title">商品の出品</h1>

    <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品画像 --}}
        <div class="sell__section">
            <p class="sell__label">商品画像</p>
            <div class="sell__image-box">
                {{-- TODO: 画像アップロード処理 --}}
                <button type="button" class="sell__image-button">画像を選択する</button>
                <input type="file" name="image" class="sell__input" accept="image/*">
            </div>
        </div>

        {{-- 商品の詳細 --}}
        <div class="sell__section">
            <h2 class="sell__section-title">商品の詳細</h2>

            {{-- カテゴリー --}}
            <div class="sell__field">
                <p class="sell__label">カテゴリー</p>
                <ul class="sell__category-list">
                    {{-- TODO: カテゴリー複数選択実装 --}}
                    @foreach ($categories as $category)
                    <li class="sell__category-item">
                        <label>
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- 商品の状態 --}}
            <div class="sell__field">
                <label class="sell__label" for="condition">商品の状態</label>
                <select name="condition_id" id="condition" class="sell__select">
                    <option value="" disabled selected>選択してください</option>
                    @foreach ($conditions as $condition)
                    <option value="{{ $condition->id }}" {{ old('condition_id') == $condition->id ? 'selected' : '' }}>
                        {{ $condition->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- 商品名と説明 --}}
        <div class="sell__section">
            <h2 class="sell__section-title">商品名と説明</h2>

            <div class="sell__field">
                <label class="sell__label" for="name">商品名</label>
                <input type="text" name="name" id="name" class="sell__input" value="{{ old('name') }}">
            </div>

            <div class="sell__field">
                <label class="sell__label" for="brand">ブランド名</label>
                <input type="text" name="brand_name" id="brand" class="sell__input" value="{{ old('brand_name') }}">
            </div>

            <div class="sell__field">
                <label class="sell__label" for="description">商品の説明</label>
                <textarea name="description" id="description" class="sell__textarea">{{ old('description') }}</textarea>
            </div>

            <div class="sell__field">
                <label class="sell__label" for="price">販売価格</label>
                <div class="sell__input-wrapper">
                    <span class="sell__price-symbol">¥</span>
                    <input type="number" name="price" id="price" class="sell__input" value="{{ old('price') }}">
                </div>
            </div>
        </div>

        {{-- 出品ボタン --}}
        {{-- TODO: 保存処理はControllerフェーズで実装 --}}
        <div class="sell__field">
            <button type="submit" class="sell__submit">出品する</button>
        </div>

    </form>
</div>

@endsection