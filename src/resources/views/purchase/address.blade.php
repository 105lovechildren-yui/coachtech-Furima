@extends('layouts.app')

@section('title', '住所の変更')

@section('content')
<div class="address">
    <h1 class="address__title">住所の変更</h1>

    <form class="address__form" method="POST" action="{{ route('purchase.address.update', $item->id) }}">
        @csrf
        @method('PATCH')

        <div class="address__field">
            <label class="address__label" for="postal_code">郵便番号</label>
            <input
                class="address__input"
                type="text"
                id="postal_code"
                name="postal_code"
                value="{{ old('postal_code', $profile->postal_code) }}">

            @error('postal_code')
            <p class="address__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="address__field">
            <label class="address__label" for="address">住所</label>
            <input
                class="address__input"
                type="text"
                id="address"
                name="address"
                value="{{ old('address', $profile->address) }}">
            @error('address')
            <p class="address__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="address__field">
            <label class="address__label" for="building">建物名</label>
            <input
                class="address__input"
                type="text"
                id="building"
                name="building"
                value="{{ old('building', $profile->building) }}">
            @error('building')
            <p class="address__error">{{ $message }}</p>
            @enderror
        </div>

        <button class="address__button" type="submit">更新する</button>
    </form>
</div>
@endsection