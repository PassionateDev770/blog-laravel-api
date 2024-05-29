<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['guest'])->group(function () {

    Route::get('getImage/{path}', [ArticleController::class, 'getImage']);
    Route::get('hello', [ArticleController::class, 'hello']);

    Route::resources([
        'categories' => CategoryController::class,
        'articles' => ArticleController::class,
    ]);
});
