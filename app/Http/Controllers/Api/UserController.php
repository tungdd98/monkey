<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User as Model;

class UserController extends Controller
{
    private $model;
    private $controller = 'user';

    public function __construct() {
        $this->middleware(['auth:api']);
        $this->model = new Model();    
    }

    public function __invoke(Request $request) {
        $user = $request->user();
        return response()->json([
            'id'    => $user->id,
            'email' => $user->email,
            'name'  => $user->name,
            'level' => $user->level,
            'address' => $user->address,
            'birthday' => $user->birthday,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'city' => $user->city,
            'district' => $user->district,
            'ward' => $user->ward
        ]);
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
     * Xoá phần tử
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->model->deleteItem($request, ['task' => 'item']);
    }

}
