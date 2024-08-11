@extends('layouts.books-layout') 

@section('title', $title)

{{-- show success message if any  --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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
                <th>Created at</th>
                <th>Updated at</th>
                <th>Delated at</th>
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
                    <td>{{ $book->user_id }}</td>
                    <td>{{ $book->created_at }}</td>
                    <td>{{ $book->updated_at }}</td>
                    <td>{{ $book->deleted_at }}</td>
                    <td>
                        <form action="{{ route('books.edit', $book->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit">Restore</button>
                        </form>
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