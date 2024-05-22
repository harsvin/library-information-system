<!-- resources/views/borrowing_records/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Borrowing Records
                        <form method="GET" action="{{ route('borrowing_records.index') }}" class="form-inline float-right">
                            <select name="search_by" id="search_by" class="form-control mr-sm-2" onchange="updatePlaceholder()">
                                <option value="ic">Search by IC Number</option>
                                <option value="book">Search by Book ID</option>
                            </select>
                            <input type="text" name="search" id="search" class="form-control mr-sm-2" placeholder="Search by IC Number" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-outline-success">Search</button>
                        </form>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('borrowing_records.create') }}" class="btn btn-primary mb-3">Add Borrowing Record</a>

                        <table class="table table-bordered">
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
                            @forelse($records as $record)
                                <tr>
                                    <td>{{ $record->book->title }}</td>
                                    <td>{{ $record->member->name }}</td>
                                    <td>{{ $record->borrow_date }}</td>
                                    <td>{{ $record->return_date ?? 'Not returned yet' }}</td>
                                    <td>
                                        <a href="{{ route('borrowing_records.edit', $record->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('borrowing_records.destroy', $record->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No records found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                            {{ $records->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updatePlaceholder() {
            const searchBy = document.getElementById('search_by').value;
            const searchInput = document.getElementById('search');
            if (searchBy === 'ic') {
                searchInput.placeholder = 'Search by IC Number';
            } else if (searchBy === 'book') {
                searchInput.placeholder = 'Search by Book ID';
            }
        }
    </script>
@endsection
