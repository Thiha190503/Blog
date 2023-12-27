<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Models\Article;

Auth::routes();

Route::get('/', [ArticleController::class, 'index']);

// Article

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/articles/detail/{id}', [
    ArticleController::class,
    'detail'
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/articles/add', [
    ArticleController::class,
    'add'
]);

Route::post('/articles/add', [
    ArticleController::class,
    'create'
]);

Route::get('/articles/delete/{id}', [
    ArticleController::class,
    'delete'
]);

Route::get('/articles/edit/{id}', [
    ArticleController::class,
    'edit'
]);

Route::post('/articles/update', [
    ArticleController::class,
    'update'
]);

// Comment
Route::post('/comments/add', [
    CommentController::class,
    'create'
]);

Route::get('/comments/delete/{id}', [
    CommentController::class,
    'delete'
]);

Route::get('/comments/edit/{id}', [
    CommentController::class,
    'edit'
]);

Route::post('/comments/update', [
    CommentController::class,
    'update'
]);
