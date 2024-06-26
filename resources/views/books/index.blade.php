@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center"> </div>
                <div class="card">
                    <div class="card-header">
                        Books
            <div class="col-auto">
                <a href="{{ route('books.create') }}" class="btn btn-primary float-right"> Add Book</a>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Published Year</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->category }}</td>
                    <td>
                        <span class="badge badge-{{ $book->isAvailable() ? 'success' : 'danger' }}">
                            {{ $book->isAvailable() ? 'Available' : 'Unavailable' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $books->links('pagination::bootstrap-4') }}
    </div>
@endsection
