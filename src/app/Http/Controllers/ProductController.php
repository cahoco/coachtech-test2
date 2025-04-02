<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Season;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('sort')) {
            $sort = $request->sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $sort);
        }
        $products = $query->paginate(6)->withQueryString();
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        // 検索条件
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え条件
        if ($request->filled('sort')) {
            $sort = $request->sort === 'asc' ? 'asc' : 'desc';
            $query->orderBy('price', $sort);
        }

        // ページネーション＋クエリ保持
        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        $path = $request->file('image')->store('products', 'public');
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);
        $product->seasons()->attach($request->seasons);
        return redirect()->route('products.index')->with('success', '商品を登録しました。');
    }

    public function show($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('products.show', compact('product', 'seasons'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // 画像アップロード処理
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $product->image = $path;
        }

        $product->save();

        // 中間テーブル（season）更新
        $product->seasons()->sync($request->seasons);

        return redirect()->route('products.index')->with('success', '商品情報を更新しました。');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        
        // 中間テーブルから先に削除（外部キー制約のため）
        $product->seasons()->detach();

        // 商品画像があれば削除（任意）
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました。');
    }
}
