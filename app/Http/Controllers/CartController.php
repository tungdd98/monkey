<?php

namespace App\Http\Controllers;

use App\Models\Bill as Model;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addCart(Request $request) {
        $cart = new Model([
            'customer_id'   => $request->customer_id,
            'status'        => 0,
            'user_id'       => $request->user_id,
            'total'         => $request->total,
            'quantity'      => $request->quantity,
            'time_intend'   => $request->time_intend
        ]);
        $cart->save();
        $products = $request->products;
        foreach($products as $key => $value) {
            $cart->products()->attach($value[0], [
                'quantity' => $value[2]
            ]);
        }
        return $cart;
    }
}
