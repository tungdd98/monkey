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
        unlink($imgPath);
        $this->model->deleteItem($request, ['task' => 'item']);
    }
    /**
     * Đệ quy lấy parent_id
     */
    public function getMultiCategory() {
        $items = Model::select(['title', 'id', 'parent_id'])->get();
        $items = $this->unique($items);
        return response()->json(['data' => $items]);
    }

    /**
     * Hàm đệ quy lấy category
     * 
     * @param $categories
     * @param $parent_id
     * @param $level
     * @return $categories
     */
    public function unique($categories = null, $parent_id = 0, $level = 0) {
        foreach($categories as $key => $item) {
            if($item['parent_id'] == $parent_id) {
                $params['id'] = $parent_id;
                $item['parent'] = $this->model->getItemById($params, ['columns' => ['title', 'id']]);
                $item['level'] = $level;
                $this->unique($categories, $item['id'], $level + 1);
            }
        }
        return $categories;
    }
}
