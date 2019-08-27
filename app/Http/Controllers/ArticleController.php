<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get()->toArray();
        return $articles;
    }

    public function store(Request $request)
    {
        $article = $request->isMethod('put') ? Article::findOrFail($request->article_id) : new Article;
        $article->id = $request->input('article_id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');

        if ($article->save()) {
            return $article;
        }
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return $article;
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        if ($article->delete()) {
            return $article;
        }
    }
}