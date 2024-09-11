<?php

use App\Http\Controllers\Article\ArticleControlle;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    
    Route::apiResource( 'article',ArticleControlle::class);
    
});