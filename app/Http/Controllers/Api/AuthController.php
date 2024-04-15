<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; // Importar la clase Hash
use App\Models\User; // Importar el modelo User

class AuthController extends Controller{

    public function login(Request $request){
    $loginData = $request->validate([
        'email' => 'email|required',
        'password' => 'required'
    ]);
    if(!auth()->attempt($loginData)){
        return response([
            'response' => 'Contraseña o correo incorrecto',
        ],401);
    }
    $accessToken=auth()->user()->createToken('authToken')->accessToken;


    return response([
        'profile' => auth() -> user (),
        'access_token' => $accessToken,
        'message' => 'success'
        ]);
}
}


