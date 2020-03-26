<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category as Model;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = null;
        if($request->action == 'tree') {
            $items = Model::get()->toTree();
        } else if($request->action == 'all') {
            $items = Model::get();
        }
        return response()->json(['data' => $items]);
    }
}
