<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;

class ProductController extends Controller
{
    // 商品一覧
    public function index()
    {
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }
    //検索
    public function search(Request $request)
    {
        $query = Product::query();

        // 商品名検索
        if ($request->keyword) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え
        if ($request->sort == 'high') {
        $query->orderBy('price', 'desc');
        }

        if ($request->sort == 'low') {
        $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    // 商品詳細
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品登録画面
    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    // 商品登録処理
    public function store(Request $request)
    {
        $product = Product::create($request->only([
            'name',
            'price',
            'image',
            'description'
        ]));

        $product->seasons()->attach($request->seasons);

        return redirect('/products');
    }

    // 商品編集画面
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::all();

        return view('products.edit', compact('product','seasons'));
    }

    // 商品更新
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->only([
            'name',
            'price',
            'image',
            'description'
        ]));

        $product->seasons()->sync($request->seasons);

        return redirect('/products');
    }

    // 削除
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/products');
    }
}
