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

Route::get('/admin', [\App\Http\Controllers\Admin\IndexController::class, 'index'])->name('admin');



Auth::routes();

