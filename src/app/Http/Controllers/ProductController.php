<?php

namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 商品一覧画面表示
    public function index(Request $request)
    {
        $sortOrder = $request->input('sort');//ソート順を取得
        if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = null; // 無効な値の場合はデフォルトに設定
        }
        // クエリを作成
        $query = Product::query();
        if ($sortOrder) {
            $query->orderBy('price', $sortOrder); // ソート条件を適用
        }
        // 商品を取得
        $products = $query->paginate(6); // ページネーション
        return view('products', compact('products', 'sortOrder'));
    }

    // 商品検索機能
    public function search(Request $request)
    {
        $products = Product::with('seasons')->NameSearch($request->name)->paginate(6);
        return view('products', compact('products'));
    }

    // 商品登録画面表示
    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    // 商品登録機能
    public function create(ProductRequest $request)
    {
        $productData = $request->except('season');//季節以外を取り出す
        $imagePath = $request->file('image')->store('public/fruits-img');//fruits-imgに保存
        $productData['image'] = $imagePath;// 保存したパスを商品データに追加
        $seasonIds = $request->input('season', []);//季節だけを取り出す
        $product = Product::create($productData);//季節以外を保存
        $product->seasons()->attach($seasonIds);// 季節情報を中間テーブルに追加
        return redirect()->route('products.index');
    }

    // 商品詳細画面表示
    public function detail($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $seasons = Season::all();
        return view('detail', compact('product', 'seasons'));
    }

    // 商品情報更新機能
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }//更新前の画像削除
        $imagePath = $request->file('image')->store('public/fruits-img');//fruits-imgに保存
        $product->image = $imagePath;
        $productData = $request->except(['_token', 'season','image']);// 季節と写真以外のデータ
        $seasonIds = $request->input('season', []); // 選択された季節 (デフォルト空配列)
        $product->update($productData);// 季節以外の商品情報を更新
        $product->seasons()->sync($seasonIds);//中間テーブル更新
        return redirect()->route('products.index');
    }

    // 商品削除機能
    public function delete($productId)
    {
        $product = Product::with('seasons')->findOrFail($productId);
        $product->delete();
        Storage::delete('public/fruits-img/' . $product->image);
        return redirect()->route('products.index');
    }


}
