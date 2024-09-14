<?php

namespace App\Http\Controllers\Admin\Article;

use App\Events\NewArticle;
use App\Exceptions\Handler;
use App\Models\Article;
use App\Service\ImageUploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleRequest;
use App\Http\Resources\Article\ArticleResource;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleControlle extends Controller
{

    private ImageUploadService $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService){
        $this->imageUploadService = $imageUploadService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        $article = Article::with('author')->get();
        return ArticleResource::collection($article);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request):ArticleResource
    {

        $user = auth('sanctum')->user();
        $imagePath = $this->imageUploadService->uploadImage($request,'image','images');

        $article = new Article();
        $article->title = $request->title;
        $article->image = $imagePath;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->published_at = Carbon::parse($request->published_at);
        $article->author_id = $user->id;
        $article->category_id = $request->category_id;
        $article->save();

        broadcast(new NewArticle($article->id,$article->title));

        return new ArticleResource($article);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article):ArticleResource
    {
        return new ArticleResource($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article):ArticleResource
    {
        $user = auth('sanctum')->user();
        $imagePath = $this->imageUploadService->updateImage($request,'image',$article->image,'images');

        $article->title = $request->title;
        $article->image = empty(!$imagePath) ? $imagePath : $article->image;
        $article->description = $request->description;
        $article->content = $request->content;
        $article->published_at = Carbon::parse($request->published_at);
        $article->author_id = $user->id;
        $article->category_id = $request->category_id;
        $article->update();

        return new ArticleResource($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): JsonResponse
    {
        $article->delete();
        return response()->json(['message'=>'Deleted Successfully'],200);
    }
}
