@extends('layouts.books-layout')

@section('content')
<section style="background-color:slateblue">
    <h2>{{$book->title}}</h2>
    <h4>{{$book->author}}</h4>
    <h4>USD {{$book->price}}</h4>
</section>
@endsection 