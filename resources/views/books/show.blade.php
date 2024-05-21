@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $book->title }}</div>
                <div class="card-body">
                    <p><strong>Title:</strong> {{ $book->title }}</p>
                    <p><strong>Author:</strong> {{ $book->author }}</p>
                    <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
                    <p><strong>Published Year:</strong> {{ $book->published_year }}</p>
                    <p><strong>Category:</strong> {{ $book->category }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

