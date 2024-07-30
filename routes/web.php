<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/books');


Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::post('/books', [BookController::class, 'store'])->name('books.store');

Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy'); 