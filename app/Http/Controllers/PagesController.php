<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Category;
use App\Models\Employee;
use App\Models\Tag;
use App\Rules\ReCaptcha;
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
        $articlesOfCategory = Article::orderBy('created_at', 'desc')->paginate(15);
        return view('front.blog.blog_page', compact('articlesOfCategory'));
    }

    public function category($name)
    {
        $category = Category::where('name', $name)->first();
        $articlesOfCategory = Article::where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
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

    public function singlePage($heading, Request $request)
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

        $comments = ArticleComment::where('allowed', 1)->where('article_id', $article->id)->get();
        return view('front.single_page.single_page', compact(
            'article',
            'moreBlogArticles',
            'popularArticles',
            'tags',
            'categories',
            'comments'
        ));
    }

    public function storeComment(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:40'],
            'comment' => ['required', 'string', 'min:5'],
            'article_id' => ['required', 'exists:articles,id', 'integer'],
            'g-recaptcha-response' => new ReCaptcha()
        ]);
        $data['created_at'] = now();
        //$data['allowed'] = 1;
        $newComment = new ArticleComment();
        $newComment->fill($data);
        $newComment->save();

        return response()->json([
            'message' => 'Comment is saved!',
        ]);
    }

}
