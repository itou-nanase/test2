@extends('layouts.app')

@section('content')
<div class="register-wrapper">
<h1>商品登録</h1>
    <form action="/products/store" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label>商品名</label>
            <input type="text" name="name" class="form-input">
        </div>

        <!-- 値段 -->
        <div class="form-group">
            <label>値段</label>
            <input type="number" name="price" class="form-input">
        </div>

        <!-- 商品画像 -->
        <div class="form-group">
            <label>商品画像</label>
            <input type="file" name="image">
        </div>

        <!-- 季節 -->
        <div class="form-group">
    <label>季節</label>

    <label>
        <input type="checkbox" name="season[]" value="spring"> 春
    </label>

    <label>
        <input type="checkbox" name="season[]" value="summer"> 夏
    </label>

    <label>
        <input type="checkbox" name="season[]" value="autumn"> 秋
    </label>

    <label>
        <input type="checkbox" name="season[]" value="winter"> 冬
    </label>

</div>

        <!-- 商品説明 -->
        <div class="form-group">
            <label>商品説明</label>
            <textarea name="description" rows="5" class="form-input"></textarea>
        </div>
        <!-- 戻るボタン -->
        <button type="submit" class="register-button">戻る</button>
        <!-- 登録ボタン -->
        <button type="submit" class="register-button">登録</button>

    </form>

</div>
@endsection