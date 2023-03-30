<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::latest()->get();

        return view('petowner.article.index', compact('articles'));
    }

    public function show(Article $article) {
        return view('petowner.article.detail', compact('article'));
    }
}
