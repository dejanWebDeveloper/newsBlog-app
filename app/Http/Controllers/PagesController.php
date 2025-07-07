<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Employee;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        $employees = Employee::all();
        $articles = Article::where('ban', 1)->orderBy('created_at', 'desc')->limit(2)->get();
        return view('front.about.about_page', compact('employees', 'articles'));
    }
    public function blog()
    {
        return view('front.blog.blog_page');
    }
    public function category(Category $name)
    {
        $category = Category::where('name', $name)->first();

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
    public function singlePage($heading)
    {
        $article = Article::where('heading', $heading)->firstOrFail();
        $moreBlogArticles = Article::where('id', '!=', $article->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        return view('front.single_page.single_page', compact('article', 'moreBlogArticles'));
    }
}
