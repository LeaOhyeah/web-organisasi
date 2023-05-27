<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsFeatureController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template.main');
});

// Dashboard News Feature
Route::get('/dashboard/news/news/index', [NewsFeatureController::class, 'newsIndex']);
Route::get('/dashboard/news/news/create', [NewsFeatureController::class, 'newsCreate'])->name('news.create');
Route::post('/news/store', [NewsFeatureController::class, 'newsStore'])->name('news.store');
Route::get('/dashboard/news/news/edit/{id}', [NewsFeatureController::class, 'newsEdit'])->name('news.edit');
Route::put('/news/update', [NewsFeatureController::class, 'newsUpdate'])->name('news.update');
Route::post('/news/delete/{id}', [NewsFeatureController::class, 'newsDelete'])->name('news.delete');

Route::get('/dashboard/news/categories/index', [NewsFeatureController::class, 'categoriesIndex']);
Route::post('/category/store', [NewsFeatureController::class, 'categoryStore'])->name('category.store');
Route::post('/category/update', [NewsFeatureController::class, 'categoryUpdate'])->name('category.update');
Route::post('/category/delete', [NewsFeatureController::class, 'categoryDelete'])->name('category.delete');