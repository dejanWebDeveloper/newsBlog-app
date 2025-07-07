<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        return view('front.about.about_page');
    }
    public function blog()
    {
        return view('front.blog.blog_page');
    }
    public function category(Category $category)
    {
        //$category = Category::all();
        return view('front.category.category_page', compact('category'));
    }
    public function contact()
    {
        return view('front.contact.contact_page');
    }
    public function searchResult()
    {
        return view('front.search_result.search_result_page');
    }
    public function singlePage(Article $article)
    {
        $article = Article::where('id', '=', $article->id)->limit(1)->get();
        return view('front.single_page.single_page', compact('article'));
    }
}
