@extends('layouts.app')

@section('content')
<div class="register-wrapper">
<h1>商品登録</h1>
    <form action="/products/store" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label>商品名<span class="required">必須</span></label>
            <input type="text" name="name" class="form-input" value="{{ old('name','キウイ') }}">
            @error('name')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label>値段<span class="required">必須</span></label>
            <input type="number" name="price" class="form-input" value="{{ old('price', 500) }}">
            @error('price')
            <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label>商品画像<span class="required">必須</span></label>
            <input type="file" name="image">
            <img id="preview" src="/images/kiwi.png" style="width:150px;margin-top:10px;">
            @error('image')
            <p class="error-message">{{ $message }}</p>
            @enderror


        <script>
            document.querySelector('input[name="image"]').addEventListener('change', function(e){
                const file = e.target.files[0];
                const reader = new FileReader();

            reader.onload = function(e){
                document.getElementById('preview').src = e.target.result;
            }

            reader.readAsDataURL(file);
        });
        </script>
        </div>

        <!-- 季節 -->
        <div class="form-group">
            <label>季節<span class="required">必須</span></label>
        @foreach ($seasons as $season)
        <label>
            <input type="checkbox" name="season[]" value="{{ $season->id }}"
            {{ in_array(1, old('season', [])) ? 'checked' : '' }}>
            {{ $season->name }}
        </label>
        @endforeach

            @error('season')
            <p class="error-message">{{ $message }}</p>
            @enderror

        </div>

        <!-- 商品説明 -->
        <div class="form-group">
            <label>商品説明<span class="required">必須</span></label>
            <textarea name="description" rows="5" class="form-input">{{ old('description','キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！') }}</textarea>

            @error('description')
            <p class="error-message">{{ $message }}</p>
            @enderror

        </div>

        <!-- 戻るボタン -->
        <a href="/products" class="back-button">戻る</a>
        <!-- 登録ボタン -->
        <button type="submit" class="register-button">登録</button>

    </form>

</div>
@endsection