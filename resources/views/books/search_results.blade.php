@extends('layouts.books-layout')


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

<a href="{{route('books.index')}}" class="btn btn-info mt-5">Books</a>


<section class="bg-light border border-dark mb-5 mt-2">
    <h1>Books</h1>
    @if ($searchResults->count() > 0)
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
                @foreach ($searchResults as $book)
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
    @else
        <p>No results found.</p>
    @endif
</section>

<section>
    <x-best-seller-books /> 
</section>

@endsection 