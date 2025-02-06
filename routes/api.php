<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// apiResource使う場合、POSTは「create」ではなく、「store」使う!!
// http://localhost:8080/api/posts, http://localhost:8080/api/posts/2でAPIデータが出る
Route::apiResource('posts', PostController::class);

// Route::get('posts', 'Api\PostController@index');
// Route::get('posts/{id}', 'Api\PostController@show');
// Route::post('posts', 'Api\PostController@store');
// Route::put('posts/{id}', 'Api\PostController@update');
// Route::delete('posts/{id}','Api\PostController@destroy');
