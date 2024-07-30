@extends('layouts.books-layout')

@section('content')
<section style="background-color:slateblue">
    <!-- add new book form -->
    <h3>Add new book</h3>
    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>
        </div>
    
        <div>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" required>
        </div>
    
        <div>
            <label for="price">Price</label>   
            <input type="number" step="0.01" name="price" id="price" required>
        </div>
    
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" required>
        </div>   
    
        <button type="submit">Add</button> 
    </form>

    <h1>Books</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Stock</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <button>edit</button>
                    </td>
                    <td>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button> 
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</section>

<section>
    <x-best-seller-books /> 
</section>

@endsection 