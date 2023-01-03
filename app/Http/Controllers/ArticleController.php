<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('categories')->get();

        return response()->json(ArticleResource::collection($articles));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();
        $userId = Auth::id();
        $data['created_by'] = $userId;
        $data['updated_by'] = $userId;

        $article = Article::create($data);
        $article->categories()->sync($data['categories']);

        return response()->json(ArticleResource::make($article), 201);
    }

    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();
        $userId = Auth::id();
        $data['updated_by'] = $userId;

        $article->update($data);

        return response()->json(ArticleResource::make($article));
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
