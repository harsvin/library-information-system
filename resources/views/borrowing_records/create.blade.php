<!-- resources/views/borrowing_records/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Borrowing Record</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('borrowing_records.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="book_id">Book</label>
                                <select class="form-control" id="book_id" name="book_id" required>
                                    @foreach($books as $book)
                                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="member_id">Member</label>
                                <select class="form-control" id="member_id" name="member_id" required>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="borrow_date">Borrow Date</label>
                                <input type="date" class="form-control" id="borrow_date" name="borrow_date" required>
                            </div>
                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">Add Borrowing Record</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
