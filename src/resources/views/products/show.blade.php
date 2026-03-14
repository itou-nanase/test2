@extends('layouts.app')

@section('content')
<form action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
    @csrf

<div class="product-detail">
    <div class="top-area">
        <div class="image-area">
        
        @if($product->image)
            <img id="preview" src="{{ asset('storage/' . $product->image) }}" class="product-image">
        @endif
        
        <input type="file" name="image">

        @error('image')
        <p class="error-message">{{ $message }}</p>
        @enderror

        </div>

        <div class="info-area">
            <div class="form-group">
                <label>商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

        <div class="form-group">
            <label>値段</label>
            <input type="text" name="price" value="{{ old('price', $product->price) }}">
            @error('price')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>季節</label>

            <input type="hidden" name="season" value="">

            @foreach ($seasons as $season)
            <label>
            <input type="checkbox"
            name="season[]"
            value="{{ $season->id }}"
            {{ in_array($season->id, (array) old('season', $productSeasons)) ? 'checked' : '' }}>

            {{ $season->name }}

            </label>
            @endforeach

                @error('season')
                <p class="error-message">{{ $message }}</p>
                @enderror
        </div>
    </div>
</div>

<div class="description-area">
    <label>商品説明</label>
    <textarea name="description">{{ old('description', $product->description) }}</textarea>
    @error('description')
    <p class="error-message">{{ $message }}</p>
    @enderror
</div>
</form>

<div class="button-area">
    <div class="left-buttons">
        <a href="/products" class="back-button">戻る</a>
        <button type="submit" class="save-button">変更を保存</button>
    </div>

    <form action="/products/{{ $product->id }}/delete" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="delete-button">
            🗑
        </button>
    </form>
</div>

@endsection