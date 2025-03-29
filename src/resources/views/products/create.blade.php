@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="product-create-page">
    <h2 class="page-title">商品登録</h2>
    <div class="product-form">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">
                <span class="label-text">商品名</span>
                <span class="required">必須</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
            @error('name')<p class="error-message">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
            <label for="price" class="form-label">
                <span class="label-text">値段</span>
                <span class="required">必須</span>
            </label>
            <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
            @error('price')<p class="error-message">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
            <label for="image">
                <span class="label-text">商品画像</span>
                <span class="required">必須</span>
            </label>
            <div class="custom-file-upload">
                <label for="image" class="file-label">ファイルを選択</label>
                <input type="file" name="image" id="image" hidden>
            </div>
            @error('image')<p class="error-message">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
            <label for="season">
                <span class="label-text">季節</span>
                <span class="required">必須</span>
                <span class="note">複数選択可</span>
            </label>
            <div class="season-options">
                @foreach($seasons as $season)
                    <label class="season-label">
                        <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                            {{ is_array(old('seasons')) && in_array($season->id, old('seasons')) ? 'checked' : '' }}>
                        {{ $season->name }}
                    </label>
                @endforeach
            </div>
            @error('seasons')<p class="error-message">{{ $message }}</p>@enderror
        </div>
        <div class="form-group">
            <label for="description">
                <span class="label-text">商品説明</span>
                <span class="required">必須</span>
            </label>
            <textarea class="description-input" name="description" id="description" placeholder="商品の説明を入力" rows="5">{{ old('description') }}</textarea>
            @error('description')<p class="error-message">{{ $message }}</p>@enderror
        </div>
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-cancel">戻る</a>
            <button type="submit" class="btn-register">登録</button>
        </div>
        </form>
    </div>
</div>
@endsection