<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        //Validamos los campos de email y contraseña 
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //con el campo email se busca a un usuario existente en la base de datos
        $user = User::where('email', $request->email)->first();

        //Si no existe el usuario y contraseña correspondiente, retorna 400
        if(!$user || Hash::check($request->password, $user->password)){
            return response([
                "error" => "Credenciales Incorrectas",
                "mesagge" => "Usuario y/o Contraseña Incorrecta"
            ], 400);
        }

        //Crear token de acceso y lo convierte a texto plano
        $token = $user -> createToken('auth_token')->plainTextToken;

        //Retornar respuesta con token
        return response([
            "access_token" => $token,
            "token_type" => "Bearer",
        ],200);
    }
}
