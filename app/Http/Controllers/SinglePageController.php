<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    public function index()
    {
        return view('app');
    }

    /**
     * Hiển thị danh sách
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getListCategories(Request $request)
    {
        $items = null;
        if ($request->action == 'tree') {
            $items = Category::get()->toTree();
        } else if ($request->action == 'all') {
            $items = Category::get();
        }
        return response()->json(['data' => $items]);
    }

    /**
     * Lấy sản phẩm có phân trang
     */
    public function getListProducts()
    {
        $items = Product::orderBy('created_at', 'desc')->paginate(9);
        foreach ($items as $key => $value) {
            $value['unit'] = Product::find($value->id)->units()->first();
            $value['supplier'] = Product::find($value->id)->suppliers()->first();
        }
        return response()->json(['data' => $items]);
    }

    /**
     * Láy sản phẩm khuyến mãi
     */
    public function getListProductsPromotion()
    {
        $items = Product::where('is_bestseller', 1)->get();
        foreach ($items as $key => $value) {
            $value['unit'] = Product::find($value->id)->units()->first();
            $value['supplier'] = Product::find($value->id)->suppliers()->first();
        }
        return response()->json(['data' => $items]);

    }

    /**
     * Lấy sản phẩm theo danh mục
     */
    public function getListProductsByCategoryId(Request $request)
    {
        $items = Category::find($request->tag)->products()->paginate(9);
        foreach ($items as $key => $value) {
            $value['unit'] = Product::find($value->id)->units()->first();
            $value['supplier'] = Product::find($value->id)->suppliers()->first();
        }
        return response()->json(['data' => $items]);
    }

    public function getListArticles()
    {
        $items = Article::orderBy('created_at', 'desc')->paginate(9);
        return response()->json(['data' => $items]);
    }
}
