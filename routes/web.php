<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;


Route::get('/', [ArticleController::class, 'index']);
Route::get('/pyaethiri', [ArticleController::class, 'index']);
Route::get('/pyaethiri/add', [ArticleController::class, 'add']);
Route::post('/pyaethiri/add', [ArticleController::class, 'create']);
Route::get('/pyaethiri/detail', function () {
    return 'pyae pyae';
})->name('pyaethiri.detail');
Route::get('/pyaethiri/detail/{id}', [ArticleController::class, 'detail']);
Route::get('/pyaethiri/delete/{id}', [ArticleController::class, 'delete']);
Route::get('/pyaethiri/edit/{id}', [ArticleController::class, 'edit']);
Route::post('/pyaethiri/edit/{id}', [ArticleController::class, 'update']);
Route::post('/comments/add', [CommentController::class, 'create']);
Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);

Route::get('/pyaethiri/more', function () {
    return redirect()->route('pyaethiri.detail');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
