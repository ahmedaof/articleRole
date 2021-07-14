<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('signup', [AuthController::class,'signup']);
    Route::post('refresh',[AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});


Route::resource('/article', ArticleController::class);
Route::resource('/category', CategoryController::class);
Route::post('/comment{id}', [ArticleController::class,'addComment']);



