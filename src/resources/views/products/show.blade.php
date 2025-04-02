@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}?v={{ time() }}">
@endsection

@section('content')
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="frame-base">
        <div class="breadcrumb">
            <a href="{{ route('products.index') }}" class="breadcrumb-link">商品一覧</a>
            <span class="breadcrumb-separator">＞</span>
            <span class="breadcrumb-current">{{ $product->name }}</span>
        </div>

        <div class="product-show-body">
            <!-- 左：画像 -->
            <div class="product-image-block">
                <div class="image-meta">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image-preview">
                    @else
                        <div class="no-image">No Image</div>
                    @endif
                    <input type="file" name="image">
                    @error('image')<p class="error-message">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- 右：商品情報 -->
            <div class="product-info-block">
                <div class="form-group">
                    <label class="form-label">商品名</label>
                    <input class="form-value" type="text" name="name" value="{{ old('name', $product->name) }}">
                    @error('name')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">値段</label>
                    <input class="form-value" type="number" name="price" value="{{ old('price', $product->price) }}">
                    @error('price')<p class="error-message">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">季節</label>
                    @foreach($seasons as $season)
                        <label>
                            <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                            {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                    @endforeach
                    @error('seasons')<p class="error-message">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <!-- 商品説明 -->
        <div class="product-description-block">
            <label class="form-label">商品説明</label>
            <textarea name="description" class="description-box">{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="error-message">{{ $message }}</p>@enderror
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="btn-cancel">戻る</a>
            <button type="submit" class="btn-register">変更を保存</button>

            {{-- 削除ボタン（ゴミ箱） --}}
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
            @csrf
                <button type="submit" class="delete-icon-button">
                    <img src="{{ asset('storage/image.png') }}" alt="削除" class="delete-icon-image">
                </button>
            </form>
        </div>
    </div>
</form>
@endsection
