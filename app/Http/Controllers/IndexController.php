<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $latestNews = Article::with('category')
            ->where('ban', 0)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        return view('front.index.index', compact(
            'categories',
            'latestNews'
        ));
    }
}
