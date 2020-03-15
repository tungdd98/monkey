<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider as Model;
use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest as MainRequest;
class Slider extends Controller
{
    private $model;
    private $controller = 'slider';
    
    public function __construct() {
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
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $params['id'] = $request->id;
        $item = $this->model->getItemById($params);
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
     * @param  \App\Models\Slider  $slider
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
}
