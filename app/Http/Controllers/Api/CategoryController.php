<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category as Model;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest as MainRequest;


class CategoryController extends Controller
{
    private $model;
    private $controller = 'category';
    
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
        $items = null;
        if($request->action == 'tree') {
            $items = Model::get()->toTree();
        } else if($request->action == 'all') {
            $items = Model::get();
        }
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
        $item = $this->model->getItemById($params, null);
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

    /**
     * Xoá phần tử và ảnh trong storage
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Model::findOrFail($request->id);
        $imgPath = "images/{$this->controller}/{$item->thumbnail}";
        if(file_exists(public_path() . $imgPath)) {
            unlink($imgPath);
        }
        $this->model->deleteItem($request, ['task' => 'item']);
    }
}
