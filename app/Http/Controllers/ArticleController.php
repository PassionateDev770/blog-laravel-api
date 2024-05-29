<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ArticleController extends BaseController
{
    public function __construct(
        protected ArticleRepository $articleRepository,
        protected ArticleService    $articleService)
    {
    }

    public function index(): JsonResponse
    {
        $articles = Article::all();

        return $this->successResponse(ArticleResource::collection($articles));
    }

    public function store(StoreArticleRequest $request): JsonResponse
    {
        $article = $this->articleRepository->create($request->validated());

        return $this->successResponse(new ArticleResource($article));
    }

    public function show(Article $article): JsonResponse
    {
        return $this->successResponse(new ArticleResource($article));
    }

    public function update(UpdateArticleRequest $request, Article $article): JsonResponse
    {
        $articleUpdated = $this->articleRepository->update($request->validated(), $article);

        return $this->successResponse(new ArticleResource($articleUpdated));
    }

    public function destroy(Article $article): JsonResponse
    {
        // Delete stored image first
        if (!is_null($article->image)) {
            $this->articleService->delete($article->image);
        }
        $article->delete();
        return $this->successResponse('Article deleted successfully');
    }

    public function getImage(string $path){
         return Storage::disk('public')->get('images/'.$path);

    }

}
