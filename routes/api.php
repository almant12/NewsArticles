<?php

use App\Http\Controllers\Admin\Article\ArticleControlle;
use App\Http\Controllers\Admin\Category\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('admin')->group(function(){
    
    Route::apiResource('category',CategoryController::class);
    Route::apiResource( 'article',ArticleControlle::class);
  
    
});