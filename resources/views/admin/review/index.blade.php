@extends('layouts_admin.app')

@section('title', 'Review List')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Reviews</h1>

    {{-- Calculate and display the average rating --}}
    @if(count($reviews) > 0)
        @php
            $averageRating = $reviews->avg('rate');
        @endphp
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Average Rating: {{ number_format($averageRating, 2) }}</h4>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            @if(count($reviews) > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Message</th>
                                <th>Rate</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>{{ $review->message }}</td>
                                    <td>{{ $review->rate }}</td>
                                    <td>{{ $review->created_at->format('d/m/Y H:i:s') }}</td> {{-- Formatting date --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning" role="alert">
                    No reviews found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
