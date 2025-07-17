<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $categoriesForDisplay = Category::orderBy('priority', 'asc')->get();
        view()->share('categoriesForDisplay', $categoriesForDisplay);

        $tagsForDisplay = Tag::orderBy('created_at', 'desc')->get();
        view()->share('tagsForDisplay', $tagsForDisplay);

        $articlesForDisplay = Article::orderBy('created_at', 'desc')->limit(3)->get();
        view()->share('articlesForDisplay', $articlesForDisplay);


   }
}
