<?php

namespace App\Repositories;

use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Support\Facades\DB;

class ArticleRepository
{
    public function __construct(protected ArticleService $articleService)
    {
    }

    /**
     * @param $data
     * @return Article
     * Les images sont envoyées en base64
     */
    public function create($data): Article
    {
        return DB::transaction(function () use ($data) {
            $article = new Article();
            $article->category()->associate($data['category_id']);
            if (isset($data['image'])) {
                $pathImage = $this->articleService->processBase64Image($data['image']);
                $data['image'] = $pathImage;
            }
            $article->fill($data);
            $article->save();
            return $article;
        }, 3);

    }

    /**
     * @param $data
     * @param Article $article
     * @return Article
     * Les images sont envoyées en base64
     */
    public function update($data, Article $article): Article
    {
        return DB::transaction(function () use ($data, $article) {
            if (isset($data['category_id'])) {
                $article->category()->associate($data['category_id']);
            }

            if (isset($data['image']) && $data['image'] !== $article->image) {
                $pathImage = $this->articleService->processBase64Image($data['image']);
                $article->image = $pathImage;
                unset($data['image']);
            }

            $article->fill($data);
            $article->save();
            return $article;
        }, 3);

    }
}
