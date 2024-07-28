<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;


Route::redirect('/', '/books');


Route::get('/books', [BookController::class, 'showBookList'])->name('index');