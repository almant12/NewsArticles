<?php

use App\Http\Controllers\Client\Article\ArticleController;
use App\Http\Controllers\Client\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function(){
    Route::get('article',[ArticleController::class,'index']);
    Route::get('article/{id}',[ArticleController::class,'show']);

    Route::get('category',[CategoryController::class,'index']);
});