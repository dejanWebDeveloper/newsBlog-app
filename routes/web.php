<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index_page');
Route::get('/about', [\App\Http\Controllers\PagesController::class, 'about'])->name('about_page');
Route::get('/blog', [\App\Http\Controllers\PagesController::class, 'blog'])->name('blog_page');
Route::get('/category/{name}', [\App\Http\Controllers\PagesController::class, 'category'])->name('category_page');
Route::get('/contact', [\App\Http\Controllers\PagesController::class, 'contact'])->name('contact_page');
Route::post('/contact/form-upload', [\App\Http\Controllers\ContactController::class, 'formUpload'])->name('contact_form_upload');
Route::get('/search-result', [\App\Http\Controllers\SearchController::class, 'searchResult'])->name('search_result_page');
Route::get('/single-page/{heading}', [\App\Http\Controllers\PagesController::class, 'singlePage'])->name('single_page');
Route::post('/store-comment', [\App\Http\Controllers\PagesController::class, 'storeComment'])->name('store_comment');

Route::middleware('auth')->prefix('/admin')->name('admin.')->group(function (){
    Route::get('', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('index');
    Route::get('/profile', [\App\Http\Controllers\Admin\IndexController::class, 'profile'])->name('profile');
    Route::name('article.')->prefix('/article')->group(function (){
       Route::get('/index', [\App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('index');
       Route::post('/ajax-article-datatable', [\App\Http\Controllers\Admin\ArticleController::class, 'datatable'])->name('datatable');
       Route::get('/add-article', [\App\Http\Controllers\Admin\ArticleController::class, 'addArticle'])->name('add-article');
       Route::post('store-article', [\App\Http\Controllers\Admin\ArticleController::class, 'storeArticle'])->name('store-article');

    });
    Route::name('category.')->prefix('/categories')->group(function (){
        Route::get('/index',[\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('index');
        Route::post('/ajax-category-datatable', [\App\Http\Controllers\Admin\CategoryController::class, 'datatable'])->name('datatable');
        Route::get('/add-category', [\App\Http\Controllers\Admin\CategoryController::class, 'addCategory'])->name('add-category');
        Route::post('store-category', [\App\Http\Controllers\Admin\CategoryController::class, 'storeCategory'])->name('store-category');

    });
    Route::name('tag.')->prefix('/tags')->group(function (){
        Route::get('/index',[\App\Http\Controllers\Admin\TagController::class, 'index'])->name('index');
        Route::post('/ajax-tag-datatable', [\App\Http\Controllers\Admin\TagController::class, 'datatable'])->name('datatable');
        Route::get('/add-tag', [\App\Http\Controllers\Admin\TagController::class, 'addTag'])->name('add-tag');
        Route::post('store-tag', [\App\Http\Controllers\Admin\TagController::class, 'storeTag'])->name('store-tag');

    });
});




Auth::routes();

