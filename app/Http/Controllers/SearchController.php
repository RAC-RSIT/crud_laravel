<?php


namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('query');
        $order = $request->input('order');

        $query = Book::query();

        if (!empty($searchQuery)) {
            $query->where('title', 'like', '%' . $searchQuery . '%')
                ->orWhere('author', 'like', '%' . $searchQuery . '%')
                ->orWhere('price', 'like', '%' . $searchQuery . '%');
            
            if ($order == 'ascending') {
                $query->orderBy('id', 'ASC');
            } else {
                $query->orderBy('id', 'DESC');;
            }
        }

        $searchResults = $query->get();

        return view('books.search_results', compact('searchResults'));
    }
}