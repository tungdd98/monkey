<?php

namespace App\Http\Controllers\AuthBasic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(Request $request) {
        return User::create($request->all());
    }
}
