<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DataType as Model;
use Illuminate\Http\Request;

class DataTypeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
        $this->model = new Model();    
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Model::select('id', 'title', 'code')->get();
        return response()->json(['data' => $items]);
    }

    /**
     * Lấy thông tin phần tử
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = Model::findOrFail($request->id)->select('id', 'title', 'code')->first();
        return response()->json(['data' => $item]);
    }
}
