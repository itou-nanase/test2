@extends('layouts.app')

@section('content')
    <div class="product-header">
        <h2>商品一覧</h2>
        <a href="/products/register" class="add-button">＋商品を追加</a>
    </div>

<div class="main">

    <div class="search-area">
        <form action="/products/search" method="GET">
            <input type="text" name="keyword" placeholder="商品名で検索">

            <button type="submit">検索</button>

        <p>価格順で表示</p>
        <select name="sort">
            <option value="">価格で並べ替え</option>
            <option value="high" {{ request('sort') == 'high' ? 'selected' : '' }}>高い順で表示</option>
            <option value="low" {{ request('sort') == 'low' ? 'selected' : '' }}>低い順で表示</option>
        </select>
        </form>
        @if(request('sort') == 'high')
            <p class="sort-result">高い順に表示
                <a href="{{ route('products', request()->except('sort')) }}" class="reset-sort">×</a>
            </p>
        @endif
        @if(request('sort') == 'low')
            <p class="sort-result">低い順に表示
                <a href="{{ route('products.search', request()->except('sort')) }}" class="reset-sort">×</a>
            </p>
        @endif            
    </div>

    <div class="product-list">

        @foreach($products as $product)

            <div class="product-card" onclick="location.href='/products/detail/{{ $product->id }}'">

               <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

                <div class="product-info">
                    <p class="product-name">{{ $product->name }}</p>
                    <p class="product-price">¥{{ $product->price }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="pagination-wrapper">
    {{ $products->appends(request()->query())->links() }}
</div>
@endsection

