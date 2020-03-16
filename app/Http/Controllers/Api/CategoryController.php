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
     * Display a listing of the resource.
     *
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MainRequest $request)
    {
        $this->model->saveItem($request, ['field' => 'add-item']);
    }

    /**
     * Display the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->model->saveItem($request, ['field' => $request->field]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $params['id'] = $request->id;
        $item = Model::findOrFail($request->id);
        $imgPath = "images/{$this->controller}/{$item->thumbnail}";
        $msg = '';
        unlink($imgPath);
        $this->model->deleteItem($params, ['task' => 'item']);
    }
    /**
     * Đệ quy lấy parent_id
     */
    public function getMultiCategory() {
        $items = Model::select(['title', 'id', 'parent_id'])->get();
        $items = $this->unique($items);
        return response()->json(['data' => $items]);
    }

    public function unique($categories = null, $parent_id = 0, $char = '') {
        foreach($categories as $key => $item) {
            if($item['parent_id'] == $parent_id) {
                $params['id'] = $parent_id;
                $item['parent'] = $this->model->getItemById($params, ['columns' => ['title', 'id']]);
                $item['char'] = $char;
                $this->unique($categories, $item['id'], $char . '|---');
            }
        }
        return $categories;
    }
}
