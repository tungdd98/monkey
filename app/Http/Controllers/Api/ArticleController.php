<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article as Model;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest as MainRequest;
class ArticleController extends Controller
{
    private $model;
    private $controller = 'article';
    
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
        unlink($imgPath);
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
}
