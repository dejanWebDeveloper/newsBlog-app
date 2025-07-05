<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');
