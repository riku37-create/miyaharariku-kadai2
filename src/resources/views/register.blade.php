@extends('layouts.app')

@section('title', 'Register')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <h1>商品登録</h1>
    <form class="register__inner" action="{{route('products.create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="register__frame">
            <div class="product__label">
                <label for="name">商品名</label>
                <span class="require">必須</span>
            </div>
            <input class="name-input" type="text" name="name" placeholder="商品名を入力" value="{{ old('name')}}">
            {{-- バリデーション --}}
            @if ($errors->any())
            @error('name')
            <p class="update-danger">{{ $message }}</p>
            @enderror
            @endif
        </div>
        <div class="register__frame">
            <div class="product__label">
                <label for="price">値段</label>
                <span class="require">必須</span>
            </div>
            <input class="price-input" type="text" name="price" placeholder="値段を入力" value="{{ old('price')}}">
            {{-- バリデーション --}}
            @if ($errors->any())
            @error('price')
            <p class="update-danger">{{ $message }}</p>
            @enderror
            @endif
        </div>
        <div class="register__frame">
            <div class="product__label">
                <label for="image">商品画像</label>
                <span class="require">必須</span>
            </div>
            <input class="image-input" type="file" name="image" placeholder="ファイルを選択" value="{{ old('image')}}">
            {{-- バリデーション --}}
            @if ($errors->any())
            @error('image')
            <p class="update-danger">{{ $message }}</p>
            @enderror
            @endif
        </div>
        <div class="register__frame">
            <div class="product__label">
                <label for="season">季節</label>
                <span class="require">必須</span>
                <span class="some">複数選択可</span>
            </div>
            <div class="season-checkbox">
                @foreach($seasons as $season)
                <div class="season-checkbox__option">
                    <input type="checkbox" name="season[]" value="{{ $season->id }}">
                    <span class="season-name">{{ $season->name }}</span>
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
        <div class="register__frame">
            <div class="product__label">
                <label for="description">商品説明</label>
                <span class="require">必須</span>
            </div>
            <input class="description-input" type="textarea" name="description" value="{{ old('description')}}"placeholder="商品の説明を入力"></input>
            {{-- バリデーション --}}
            @if ($errors->any())
            @error('description')
            <div class="update-danger">
                <p>{{ $message }}</p>
            </div>
            @enderror
            @endif
        </div>
        <div class="button">
            <a class="back" href="{{route('products.index')}}">戻る</a>
            <button class="move-register" type="submit">登録</button>
        </div>
    </form>
</div>
@endsection