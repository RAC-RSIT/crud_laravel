<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/books');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // routes related to user
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // routes related to books
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{id}', [BookController::class, 'update'])->name('books.update'); 
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    // Route::get('/books/restore', [BookController::class, 'restore_index'])->name('books.restore_index');
    // Route::put('/books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
});


// for searching book items
Route::get('/search', [SearchController::class, 'index'])->name('search');


require __DIR__.'/auth.php';