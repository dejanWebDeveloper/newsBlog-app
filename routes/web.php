<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index_page');
Route::get('/about', [\App\Http\Controllers\PagesController::class, 'about'])->name('about_page');
Route::get('/blog', [\App\Http\Controllers\PagesController::class, 'blog'])->name('blog_page');
Route::get('/category', [\App\Http\Controllers\PagesController::class, 'category'])->name('category_page');
Route::get('/contact', [\App\Http\Controllers\PagesController::class, 'contact'])->name('contact_page');
Route::get('/search-result', [\App\Http\Controllers\PagesController::class, 'searchResult'])->name('search_result_page');
