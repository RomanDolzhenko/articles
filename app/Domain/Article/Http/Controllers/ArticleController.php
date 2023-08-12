<?php

namespace App\Domain\Article\Http\Controllers;

use App\Domain\Article\Models\Article;
use App\Domain\Article\Requests\ArticleRequest;
use App\Domain\Article\Resources\ArticleResource;

class ArticleController
{
    public function index()
    {
        return view('article.index', [
            'articles' => ArticleResource::collection(Article::all())
        ]);
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(ArticleRequest $request)
    {
        return new ArticleResource(Article::create($request->validated()));
    }

    public function show(Article $category)
    {
        return new ArticleResource($category);
    }

    public function update(ArticleRequest $request, Article $category)
    {
        $category->update($request->validated());

        return new ArticleResource($category);
    }

    public function destroy(Article $category)
    {
        $category->delete();

        return response()->json();
    }
}
