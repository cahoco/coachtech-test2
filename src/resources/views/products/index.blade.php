@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="frame387">
    <div class="frame386">
        <h2>商品一覧</h2>
        <a href="{{ route('products.create') }}" class="add-button">＋商品を追加</a>
    </div>

    <div class="product-page">
        <div class="product-sidebar">
            <div class="search-section">
                <form class="search-form" action="{{ route('products.search') }}" method="GET">
                    <input class="search-input" type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">
                    <button class="search-button" type="submit">検索</button>
                </form>
            </div>
            <div class="sort-section">
                <form method="GET" action="{{ route('products.search') }}" class="sort-form">
                    <label for="sort">価格順で表示</label>
                    <select class="sort-select" name="sort" onchange="this.form.submit()">
                        <option value="" disabled {{ request('sort') === null ? 'selected' : '' }}>価格で並び替え</option>
                        <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>高い順に表示</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>低い順に表示</option>
                    </select>
                    @if(request('keyword'))
                        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                    @endif
                </form>
                @if(request('sort'))
                    <div class="filter-tag-wrapper">
                        <div class="filter-tag">
                            <span>価格順：{{ request('sort') === 'asc' ? '安い順' : '高い順' }}</span>
                            <a href="{{ route('products.search', array_merge(request()->except('sort'))) }}" class="remove-tag">×</a>
                        </div>
                    </div>
                @endif
                <div class="sort-divider"></div>
            </div>
        </div>
        <div class="product-content">
            <div class="product-list">
                @foreach ($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                        <div class="product-info">
                            <div class="product-name">{{ $product->name }}</div>
                            <div class="product-price">¥{{ number_format($product->price) }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
            {{ $products->appends(request()->all())->onEachSide(1)->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</div>
@endsection
