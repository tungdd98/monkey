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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $options = [
            'pagination' => $request->pagination, 
            'per_page' => $request->per_page,
            'order_by' => $request->order_by,
            'order_dir' => $request->order_dir
        ];
        $items = $this->model->getListItems(null, $options);
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
        $this->model->saveItem($request, ['field' => 'add-item']);
    }

    /**
     * Lấy thông tin phần tử
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $params['id'] = $request->id;
        $item = $this->model->getItemById($params);
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
        $this->model->saveItem($request, ['field' => $request->field]);
    }

    public function destroy(Request $request)
    {
        $params['id'] = $request->id;
        $item = Model::findOrFail($request->id);
        $images = json_decode($item->images);
        foreach($images as $key => $image) {
            $imgPath = "images/{$this->controller}/{$image}";
            unlink($imgPath);
        }
        $this->model->deleteItem($params, ['task' => 'item']);
    }
}
