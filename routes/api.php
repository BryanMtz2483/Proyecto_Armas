<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BasesController;
use App\Http\Controllers\Api\CountController;
use App\Http\Controllers\Api\MilitairesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//API de logueo para obtener un token tipo BEARER y así poder usar el resto de APIS
Route::post('/login',[AuthController::class, 'login']);

Route::group(['prefix' => 'v1','middleware' => 'auth:sanctum'], function (){//para poder utilizar algunas de estas rutas se necesita el token de autenticación.
    
    //para usar esta ruta se debe usar este link 127.0.0.1:8000/api/v1/information y la petición debe ser tipo GET
    Route::get('/information',[CountController::class,'index']);
    
    //para usar esta ruta se debe usar este link 127.0.0.1:8000/api/v1/militaries y la petición debe ser tipo GET
    Route::get('/militaries',[MilitairesController::class,'index']);

    //para usar esta ruta se debe usar este link 127.0.0.1:8000/api/v1/military y la petición debe ser tipo POST. Para la petición deben enviarse los campos en su cuerpo, en la sección de FORM con los siguientes campos: name,email,birth_date,join_date,credential_id,weaponLicense_id,weapon_code.
    Route::post('/military',[MilitairesController::class,'store']);

    //para usar esta ruta se debe usar este link 127.0.0.1:8000/api/v1/bases y la petición debe ser tipo GET
    Route::get('/bases',[BasesController::class,'index']);

    //para usar esta ruta se debe usar este link 127.0.0.1:8000/api/v1/base y la petición debe ser tipo POST. Para la petición deben enviarse los campos en su cuerpo, en la sección de FORM con los siguientes campos: name,location.
    Route::post('/base',[BasesController::class,'store']);
});