<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComicController;

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/users', function (Request $request) {  
        return $request->user();
    });
    
    Route::post('/logout', 'AuthController@logout');
});

Route::post('/singup', [AuthController::class, 'singup']);
//Route::post('/login', [AuthController::class, 'login']);



Route::get('/comic', [ComicController::class, 'cagetory']);


