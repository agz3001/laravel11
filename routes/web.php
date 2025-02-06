<?php

use Illuminate\Support\Facades\Route;
// 以下追加
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});


Route::get("/", [PostController::class, "index"])->name("top");
Route::resource('posts', PostController::class)->only([
    'create', 'store', 'show', 'edit', 'update', 'destroy'
]);
Route::resource("comments", CommentController::class)->only(["store"]);
Route::get("/search",[PostController::class, "search"]);

// api用
// http://localhost:8080/index で「非API」PostControllerのapiIndex functionを返す
Route::get("/index", [PostController::class, "apiIndex"]);
