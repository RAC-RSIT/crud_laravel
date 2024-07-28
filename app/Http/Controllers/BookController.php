<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Book;


class BookController extends Controller
{
    public function showBookList(): View
    {   
        $books = Book::all(); // Fetch all books from the database
        return view('index', ['books' => $books]);  // we could do the same using compact($books)
    }
} 

