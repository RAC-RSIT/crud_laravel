@extends('layouts.books-layout')

@section('title', $title)

{{-- show success message if any  --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- checking if there are any validation error --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- check if there are any other errors  --}}
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


@section('content')

<section class="bg-light border border-dark my-5">
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

        <input type="hidden" name="user_id" value={{ Auth::user()->id }}>
    
        <button type="submit" class="btn btn-primary">Add</button> 
    </form>
    
    <h1>Books</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Stock</th>
                <th>User ID</th>
                <th colspan="3">Actions</th>
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
                    <td>{{ $book->user_id }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">view</a>
                    </td>
                    <td>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">edit</a>
                    </td>
                    <td>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">delete</button> 
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