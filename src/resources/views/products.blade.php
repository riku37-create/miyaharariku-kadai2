@extends('layouts.app')

@section('title','Products')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products-heading">
    <h1 class="products-heading__title">商品一覧</h1>
    <a class="move-register" href="{{ route('products.register') }}">+商品を追加</a>
</div>
<div class="products-inner">
    {{-- 検索機能 --}}
    <div class="product-inner__left">
        <form class="search-form" action="{{ route('products.search') }}" method="get">
            @csrf
            <input class="search-form__keyword-input" type="text" name="name" placeholder="商品名で検索">
            <button class="search-form__button">検索</button>
        </form>
        <form class="search-form" action="{{ route('products.index') }}" method="get">
            <label class="line-label" for="sort">価格順で表示</label>
            <select class="line" name="sort" onchange="this.form.submit()">
                <option value="asc" {{ (isset($sortOrder) && $sortOrder == 'asc') ? 'selected' : '' }}>低い順に表示</option>
                <option value="desc" {{ (isset($sortOrder) && $sortOrder == 'desc') ? 'selected' : '' }}>高い順に表示</option>
            </select>
        </form>
        <!-- 並び替えタグ表示 -->
        @if (isset($sortOrder) && $sortOrder)
        <div class="sort-tag">
            <span class="sort-tag__label">
                {{ $sortOrder == 'asc' ? '低い順に表示' : '高い順に表示' }}
            </span>
            <a href="{{ route('products.index') }}" class="sort-tag__remove">×</a>
        </div>
        @endif
    </div>
    <div class="products-inner__light">
        <div class="cards-list">
            @foreach($products as $product)
                <div class="cards__content">
                    <a href="{{ route('products.detail', ['productId' => $product->id]) }}">
                        <img class="cards__image" src="{{ asset('storage/fruits-img/' . basename($product->image)) }}" alt="{{ $product->name }}">
                    </a>
                    <div class="cards__content-explanation">
                        <p class="cards__content-explanation-name">{{ $product->name }}</p>
                        <p class="cards__content-explanation-price">¥{{ $product->price }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="page">{{ $products->links('vendor.pagination.tailwind') }}</div>
    </div>
</div>
@endsection