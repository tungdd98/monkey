<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill as Model;
use App\Models\Customer;
use App\Models\User;

class OrderController extends Controller
{
    private $model;
    
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
     * Thay đổi trạng thái đơn hàng
     */
    public function changeStatus(Request $request) {
        $item = Model::findOrFail($request->id);
        $item->update([
            'status' => $request->status
        ]);
        return response()->json(['data' => $item]);
    }

    /**
     * Lấy thông tin phần tử
     *
     * @param  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $item = Model::findOrFail($request->id);
        if(isset($item->customer_id)) {
            $item['customer'] = Customer::find($item->customer_id);
        } else {
            $item['customer'] = User::find($item['user_id']);
        }
        $item['products'] = $item->products()->get();
        return response()->json(['data' => $item, 'id' => $item->customer_id]);
    }
}
