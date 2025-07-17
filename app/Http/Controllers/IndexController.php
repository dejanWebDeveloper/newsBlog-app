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
        $categoryNews = Category::orderBy('created_at')->take(4)->get();
        $firstCategoryNews = Article::categoryNews()
            ->where('category_id', $categoryNews[0]->id)
            ->limit(9)
            ->get();

        $secondCategoryNews = Article::categoryNews()
            ->where('category_id', $categoryNews[1]->id)
            ->limit(7)
            ->get();


        $thirdCategoryNews = Article::categoryNews()
            ->where('category_id', $categoryNews[2]->id)
            ->limit(9)
            ->get();

        $fourthCategoryNews = Article::categoryNews()
            ->where('category_id', $categoryNews[3]->id)
            ->limit(4)
            ->get();

        return view('front.index.index', compact(
            'categories',
            'latestNews',
            'firstCategoryNews',
            'secondCategoryNews',
            'thirdCategoryNews',
            'fourthCategoryNews'
        ));
    }

}
