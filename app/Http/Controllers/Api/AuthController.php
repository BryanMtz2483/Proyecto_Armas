<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        //Si no existe el usuario y contrase{a correspondiente, retorna 400

        if(!$user || Hash::check($request->password, $user->password)){
            return response([
                "error" => "Credenciales Incorrectas",
                "mesagge" => "Usuario y/o Contraseña Incorrecta"
            ], 400);
        }

        //Crear token de acceso
        $token = $user -> createToken('auth_token')->plainTextToken;

        //Retornar respuesta con token
        return response([
            "access_token" => $token,
            "token_type" => "Bearer",
        ],200);
    }
}
