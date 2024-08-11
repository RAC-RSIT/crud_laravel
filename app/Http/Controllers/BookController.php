<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class BookController extends Controller
{
    public function index(): View
    {   
        $books = Book::all(); // Fetch all active books from the database
        // $books = Book::onlyTrashed()->get();
        return view('books.index', ['books' => $books, 'title' => 'books']);  // we could do the same using compact($books)
    }
    
    public function show($id): View
    {   
        $book = DB::table('books')->where('id', $id)->first();
        return view('books.show', ['book' => $book, 'title' => 'a book']);  // we could do the same using compact($book)
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'user_id' => 'required|integer'
            ]);
    
            Book::create($validatedData);
    
            return redirect()->route('books.index')->with('success', 'Book created successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        } catch (\Exception $e) {
            // Handle other exceptions
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        // DB::table('books')->where('id', $id)->delete();
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully'); 
    }

    public function edit(string $id): View 
    {   
        return view('books.edit', ['id'=>$id, 'title'=>'edit book']);  
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255', 
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $book->update($validatedData); 

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    // public function restore_index()
    // {
    //     $books = Book::onlyTrashed()->get();

    //     return view('books.restore_index', ['books' => $books, 'title' => 'books restore']);  // we could do the same using compact($books)
    // }

    // public function restore($id)
    // {
    //     $book = Book::withTrashed()->findOrFail($id);
    //     $book->restore();

    //     return redirect()->route('books.restore_index')->with('success', 'Book restored successfully');
    // }

} 

