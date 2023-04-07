<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {

        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            return [
                "status" =>1,
                "data" => "si",
            ];
        }

        else{
            return [
                "status" =>1,
                "data" => "no validado",
            ];
        }
    }
}
