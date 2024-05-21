@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $member->name }}</div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $member->name }}</p>
                        <p><strong>IC No.:</strong> {{ $member->ic_no }}</p>
                        <p><strong>Address:</strong> {{ $member->address }}</p>
                        <p><strong>Contact Information:</strong> {{ $member->contact_info }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
