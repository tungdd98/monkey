<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider as Model;
use Illuminate\Http\Request;
use App\Http\Resources\Slider as Resource;

class Slider extends Controller
{
    private $model;
    private $params = [];
    
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
        return Resource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = [
            'id' => $request->id,
            'status' => $request->status
        ];
        $this->model->updateItem($params, ['field' => 'status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        return response()->json(['item' => $slider]);
    }
}
