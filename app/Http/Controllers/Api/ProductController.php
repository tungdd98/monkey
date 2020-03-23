<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product as Model;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest as MainRequest;

class ProductController extends Controller
{
    private $model;
    private $controller = 'product';
    
    public function __construct() {
        $this->middleware(['auth:api']);
        $this->model = new Model();    
    }
    /**
     * Hiển thị danh sách 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $options = [
            'pagination'    => $request->pagination, 
            'per_page'      => $request->per_page,
            'order_by'      => $request->order_by,
            'order_dir'     => $request->order_dir
        ];
        $items = $this->model->getListItems($options);
        return response()->json(['data' => $items]);
    }

    /**
     * Lưu phần tử 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainRequest $request)
    {
        $item = $this->model->saveItem($request, ['field' => 'add-item']);
        return response()->json(['item' => $item]);
    }

    /**
     * Lấy thông tin phần tử
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = $this->model->getItemById($request);
        return response()->json(['data' => $item]);
    }

    /**
     * Cập nhật phần tử
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $item = $this->model->saveItem($request, ['field' => $request->field]);
        return response()->json(['item' => $item]);
    }

    /**
     * Xoá phần tử
     * 
     * @param $request
     * @return response
     */
    public function destroy(Request $request)
    {
        $item = Model::findOrFail($request->id);
        $images = json_decode($item->images);
        foreach($images as $key => $image) {
            $imgPath = "images/{$this->controller}/{$image}";
            unlink($imgPath);
        }
        $this->model->deleteItem($request, ['task' => 'item']);
    }

    /**
     * Lấy danh mục của phần tử
     * 
     * @param 
     * @return response
     */
    public function getCategoryOfItem(Request $request) {
        $categories = $this->model->getCategoryOfItem($request->id, ['title']);
        return response()->json(['data' => $categories]);
    }

    /**
     * Lấy đơn vị tính
     * 
     * @param 
     * @return response
     */
    public function getUnitOfItem(Request $request) {
        $units = $this->model->getUnitOfItem($request->id, ['id', 'title']);
        return response()->json(['data' => $units]);
    }

    /**
     * Lấy nhà sản xuất
     * 
     * @param 
     * @return response
     */
    public function getSupplierOfItem(Request $request) {
        $suppliers = $this->model->getSupplierOfItem($request->id, ['id', 'title']);
        return response()->json(['data' => $suppliers]);
    }
}
