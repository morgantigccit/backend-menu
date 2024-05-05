@extends('layouts_admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($category->image)
                <img src="{{ asset($category->image) }}" class="card-img-top" alt="{{ $category->name }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    <p class="card-text">{{ $category->status ? 'Active' : 'Inactive' }}</p>
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.categories.edit', ['category_id' => $category->category_id]) }}" class="btn btn-sm btn-success">Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
