<?php

use App\Http\Controllers\Admin\CommentPostController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Grupo de rotas para Admin com middleware
Route::prefix('admin')->middleware('auth')->group(function () {
    // Rotas para Users
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Rotas para Posts
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post}/show', [PostController::class, 'show'])->name('posts.show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        
        // Rotas para comentários associados a posts
        Route::post('/{post}/comments', [CommentPostController::class, 'store'])->name('comments.store');
    });

    // Rotas para Comentários (admin global)
    Route::prefix('comments')->group(function () {
        Route::get('/{comment}/edit', [CommentPostController::class, 'edit'])->name('comments.edit'); // Corrigido o nome do parâmetro
        Route::put('/{comment}', [CommentPostController::class, 'update'])->name('comments.update');
        Route::delete('/{comment}', [CommentPostController::class, 'destroy'])->name('comments.destroy');
    });
});

// Rota inicial
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rota para Dashboard com middleware auth e verified
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupo de rotas protegidas por auth
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Importar as rotas de autenticação
require __DIR__.'/auth.php';
