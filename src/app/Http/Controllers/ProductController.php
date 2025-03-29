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
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }
        if ($request->filled('sort')) {
            $query->orderBy('price', $request->sort);
        }
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
        return view('products.show');
    }

}
