<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    public function index(): View
    {   
        $books = Book::all(); // Fetch all books from the database
        return view('books.index', ['books' => $books]);  // we could do the same using compact($books)
    }
    
    public function show($id): View
    {   
        $book = DB::table('books')->where('id', $id)->first();
        return view('books.show', ['book' => $book]);  // we could do the same using compact($book)
    }

    public function store(Request $request)
    {   
        // Create a new book instance
        $book = new Book;
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->price = $request->input('price');
        $book->stock = $request->input('stock'); 

        // Create new book in the database
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book added successfully'); 
    }

    public function destroy($id): RedirectResponse
    {
        DB::table('books')->where('id', $id)->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully'); 
    }

} 

