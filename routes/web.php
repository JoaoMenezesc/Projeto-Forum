<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckIfIsAdmin;
use App\Http\Controllers\Admin\PostController;
Route::prefix('admin')
->group(function () {
    
    Route::delete('/posts/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{post}/show', [PostController::class, 'show'])->name('posts.show');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


    Route::delete("/users/{user}/destroy", [UserController::class, "destroy"])->name("users.destroy"); 
    Route::get("/users/create", action: [UserController::class, "create"])->name("users.create");
    Route::get("/users/{user}", [UserController::class, "show"])->name("users.show");
    Route::put("/users/{user}/", [UserController::class, "update"])->name("users.update");
    Route::get("/users/{user}/edit", [UserController::class, "edit"])->name("users.edit");
    Route::post("/users", [UserController::class, "store"])->name("users.store");
    Route::get("/users", [UserController::class, "index"])->name("users.index");
});




Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
