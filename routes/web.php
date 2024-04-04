<?php

use App\Http\Controllers\Api\DogApiController;
use App\Http\Controllers\Api\LikeApiController;
use App\Http\Controllers\Api\UnlikeApiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return redirect(route('login'));
})->name('main');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('api/v1/dogs')->middleware('auth')->group(function () {
    Route::get('/', [DogApiController::class, 'index'])->name('api.dog.lists');
    Route::get('/random-images', [DogApiController::class, 'randomImage'])->name('api.dog.random-image');
    Route::post('/like', [LikeApiController::class, 'store'])->name('api.dog.like');
    Route::post('/unlike', [UnlikeApiController::class, 'store'])->name('api.dog.unlike');
});

Route::controller(UserController::class)->prefix('users')->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('users.index');
    Route::get('/{user:uuid}', 'show')->name('users.show');
});

require __DIR__.'/auth.php';
