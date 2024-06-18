@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Borrowing Records</div>
            <div class="card-body">
            <div class="col-auto">
                <a href="{{ route('borrowing_records.create') }}" class="btn btn-primary float-right"> Add Borrowing Record</a>
            </div>
                <form method="GET" action="{{ route('borrowing_records.index') }}" class="form-inline mb-3">
                    <div class="form-group mr-2">
                        <label for="search_by" class="mr-2">Search By</label>
                        <select class="form-control" id="search_by" name="search_by">
                            <option value="ic">IC No.</option>
                            <option value="book">Book ID</option>
                        </select>
                    </div>
                    <div class="form-group mr-2">
                        <label for="search" class="mr-2">Search</label>
                        <input type="text" class="form-control" id="search" name="search">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Member Name</th>
                        <th>Borrow Date</th>
                        <th>Return Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($records as $record)
                        <tr>
                            <td>{{ $record->book->title }}</td>
                            <td>{{ $record->member->name }}</td>
                            <td>{{ $record->borrow_date }}</td>
                            <td>{{ $record->return_date ?? 'Not returned yet' }}</td>
                            <td>
                                <a href="{{ route('borrowing_records.edit', $record->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('borrowing_records.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $records->links() }}
            </div>
        </div>
    </div>
@endsection
