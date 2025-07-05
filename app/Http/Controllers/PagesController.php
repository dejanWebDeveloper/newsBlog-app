<?php

namespace App\Http\Controllers;

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
    public function category()
    {
        return view('front.category.category_page');
    }
}
