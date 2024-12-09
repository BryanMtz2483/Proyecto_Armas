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

Route::post('/login',[AuthController::class, 'login']);

Route::group(['prefix' => 'v1','middleware' => 'auth:sanctum'], function (){
    Route::get('/information',[CountController::class,'index']);
    Route::get('/militaries',[MilitairesController::class,'index']);
    Route::post('/military',[MilitairesController::class,'store']);
    Route::get('/bases',[BasesController::class,'index']);
    Route::post('/base',[BasesController::class,'store']);
});