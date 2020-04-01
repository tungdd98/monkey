<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as Model;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Lấy sản phẩm có phân trang
     */
    public function index() {
        $items = Model::orderBy('created_at', 'desc')->paginate(12);
        foreach($items as $key => $value) {
            $value['unit'] = Model::find($value->id)->units()->first();
            $value['supplier'] = Model::find($value->id)->suppliers()->first();
        }
        return response()->json(['data' => $items]);
    }

    /**
     * Lấy sản phẩm theo danh mục
     */
    public function getItemByCategoryId(Request $request) {
        $items = Category::find($request->tag)->products()->paginate(12);
        foreach($items as $key => $value) {
            $value['unit'] = Model::find($value->id)->units()->first();
            $value['supplier'] = Model::find($value->id)->suppliers()->first();
        }
        return response()->json(['data' => $items]);
    }
}
