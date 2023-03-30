<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $newArticle = Article::latest()->first();
        $newProducts = Product::with('category')->latest()->limit(4)->get();
        $vets = Vet::with('user')->inRandomOrder()->limit(4)->get();

        return view('petowner.home', compact('newArticle', 'newProducts', 'vets'));
    }
}
