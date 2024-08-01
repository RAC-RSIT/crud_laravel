@extends('layouts.books-layout')

@section('title', $title)

@section('content') 

<section class="bg-light border border-dark my-5">
    <h3>Update book</h3>
    <form action="{{ route('books.update', $id) }}" method="POST">
        @csrf
        @method('PATCH')
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

        <input type="hidden" name="user_id" value="1">
    
        <button type="submit" class="btn btn-primary">Update</button> 
    </form>
</section>

@endsection 