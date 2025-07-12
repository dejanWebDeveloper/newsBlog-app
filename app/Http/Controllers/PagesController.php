<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Tag;
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
    public function category($name)
    {
        $category = Category::where('name', $name)->first();
        $articlesOfCategory = Article::where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $popularArticles = Article::with('category')->whereNotIn('heading', $articlesOfCategory->pluck('heading'))
            ->orderBy('created_at', 'asc')
            ->where('ban', 0)
            ->limit(3)
            ->get();
        $tags = Tag::all();
        $categories = Category::all();
        return view('front.category.category_page', compact(
            'category',
        'articlesOfCategory',
            'popularArticles',
            'tags',
            'categories'
        ));
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
        $popularArticles = Article::where('id', '!=', $article->id)
            ->orderBy('created_at', 'asc')
            ->where('ban', 0)
            ->limit(3)
            ->get();
        $tags = Tag::all();
        $categories = Category::all();
        $comments = ArticleComment::where('allowed',1)->get();
        return view('front.single_page.single_page', compact(
            'article',
            'moreBlogArticles',
            'popularArticles',
            'tags',
            'categories',
            'comments'
        ));
    }
    public function storeComment()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:40'],
            'comment' => ['required', 'string'],
            'article_id' => ['required', 'exists:articles,id', 'integer']
        ]);
        $data['created_at'] = now();
        $data['allowed'] = rand(0, 1);
        $newComment = new ArticleComment();
        $newComment->fill($data);
        $newComment->save();

        return response()->json([
            'message' => 'Comment is saved!',
        ]);
    }

}
