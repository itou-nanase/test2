<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

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
        $seasons = Season::all();
        
         // 商品に紐づく季節IDを配列で取得
        $productSeasons = DB::table('product_season')
            ->where('product_id', $id)
            ->pluck('season_id')
            ->toArray();


        return view('products.show', compact('product','seasons','productSeasons'));
    }

    // 商品登録画面
    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    // 商品登録処理
    public function store(ProductRequest $request)
    {
        // 画像保存
        $image_Path = $request->file('image')->store('images');

        if ($request->hasFile('image')) {
            $image_Path = $request->file('image')->store('images', 'public');
        } else {
            $image_Path = null;
        }

        //商品保存
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image_Path,
            'description' => $request->description,
        ]);

        $product->seasons()->attach($request->season);

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
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->only([
            'name',
            'price',
            'description'
        ]);

        if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $data['image'] = $path;
        }

        $product->update($data);

        return redirect('/products');
    }

    // 削除
    public function destroy($id)
    {
    $product = Product::findOrFail($id);

    Storage::disk('public')->delete($product->image);

    $product->delete();

    return redirect('/products');
    }
}
