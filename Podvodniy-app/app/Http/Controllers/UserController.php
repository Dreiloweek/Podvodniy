<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request){
        $reg = $request->validate([
            'reg-password-field' => 'required|string|min:5',
        ]);
    }
}
