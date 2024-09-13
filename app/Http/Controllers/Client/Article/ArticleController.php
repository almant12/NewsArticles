<?php

namespace App\Http\Controllers\Client\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Client\ArticleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    

    public function index(Request $request): JsonResource{
        if($request->has('category')){
            $category = Category::where('name',$request->category)->firstOrFail();
            $articles = Article::where('category_id',$category->id)->get();
            return ArticleResource::collection($articles);
        }else{
            $articles = Article::all();
            return ArticleResource::collection($articles);
        }
    }

    public function show($id):JsonResponse{

        $article = Article::findOrFail($id)->load('author');
        $related_articles = Article::where('category_id',$article->category_id)
        ->where('id','!=',$article->id)->take(3)->get();

        return response()->json([
            'article'=>new ArticleResource($article),
            'related_articles'=>ArticleResource::collection($related_articles)
        ],200);
    }

}
