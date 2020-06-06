<?php

namespace App\Http\Controllers;

use App\Models\Bill as Model;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;
class CartController extends Controller
{
    public function addCart(Request $request) {
        $cart = new Model([
            'status'        => 0,
            'total'         => $request->total,
            'quantity'      => $request->quantity,
            'time_intend'   => $request->time_intend
        ]);
        if(!empty($request->user_id)) {
            $cart['user_id'] = $request->user_id;
        }
        $test = [];
        if(!empty($request->isCustomer)) {
            $customer = new Customer([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'address' => $request->address
            ]);
            $customer->save();
            $cart['customer_id'] = $customer->id;
        }
        $cart->save();
        $products = $request->products;
        foreach($products as $key => $value) {
            $cart->products()->attach($value[0], [
                'quantity' => $value[2]
            ]);
            $itemProduct = Product::where('id', $value[0])->first();
            $numberQuantityUpdate = (int)($itemProduct['quantity']) - (int)($value[2]);
            Product::where('id', $value[0])->update(['quantity' => $numberQuantityUpdate]);
        }
        return $cart;
    }
}
