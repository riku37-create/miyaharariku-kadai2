@extends('layouts.app')

@section('title', 'Detail')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail">
    <form class="product-detail" action="{{ route('products.update', ['productId' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="product-top">
            <div class="top-left">
                <div class="tag-list">
                    <span class="tag-blue">商品一覧</span>
                    <span class="tag">>{{ $product->name }}</span>
                </div>
                <img class="product__image" src="{{ asset('storage/fruits-img/' . basename($product->image)) }}" alt="{{ $product->name }}">
                <div class="file-button">
                    <input class="file-control" type="file" name="image" placeholder="ファイルを選択">
                    <span class="file-name">{{ $product->image }}</span>
                </div>
                {{-- バリデーション --}}
                @if ($errors->any())
                @error('image')
                <p class="update-danger">{{ $message }}</p>
                @enderror
                @endif
            </div>
            <div class="top-right">
                <div class="product__form">
                    <label class="product__form-label" for="name">商品名</label>
                    <input class="product__form-input" type="text" name="name" value="{{ $product->name }}" placeholder="商品名を入力">
                {{-- バリデーション --}}
                @if ($errors->any())
                @error('name')
                <p class="update-danger">{{ $message }}</p>
                @enderror
                @endif
                </div>
                <div class="product__form">
                    <label class="product__form-label" for="price">値段</label>
                    <input class="product__form-input" type="text" name="price" value="{{ $product->price }}" placeholder="値段を入力">
                    {{-- バリデーション --}}
                    @if ($errors->has('price'))
                    @foreach ($errors->get('price') as $error){{--複数表示できていない--}}
                    <p class="update-danger">{{ $error }}</p>
                    @endforeach
                    @endif
                </div>
                <div class="product__form">
                    <label class="product__form-label" for="season">季節</label>
                    <div class="product__season-input">
                        @foreach($seasons as $season)
                        <div class="product__season-option">
                            <input  class="product__season-input"
                                type="checkbox"
                                name="season[]"{{--複数選択のため--}}
                                value="{{ $season->id }}"
                                {{ $product->seasons->pluck('id')->contains($season->id) ? 'checked' : '' }}>{{--チェックの出力--}}
                            <span class="product__season-label">{{ $season->name }}</span>
                        </div>
                        @endforeach
                    </div>
                    {{-- バリデーション --}}
                    @if ($errors->any())
                    @error('season')
                    <p class="update-danger">{{ $message }}</p>
                    @enderror
                    @endif
                </div>
            </div>
        </div>
        <div class="product-bottom">
            <label class="product__description-label" for="description">商品説明</label>
            <textarea class="product__description" name="description" placeholder="商品の説明を入力">{{ $product->description }}</textarea>
            {{-- バリデーション --}}
            @if ($errors->any())
            @error('description')
            <p class="update-danger">{{ $message }}</p>
            @enderror
            @endif
        </div>
        <div class="button">
            <a class="back" href="/products">戻る</a>
            <button class="update">変更を保存</button>
        </div>
    </form>
    <div class="product-button">
        <form action="{{ route('products.delete',['productId' => $product->id]) }}" method="post">
            @csrf
            @method('DELETE')
            <button class="submit">
                <i class="fa-regular fa-trash-can" style="color: #ff0000;"></i>
            </button>
        </form>
    </div>
</div>
@endsection