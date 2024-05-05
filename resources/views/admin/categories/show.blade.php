{{-- resources/views/admin/categories/show.blade.php --}}

@extends('layouts_admin.app')


@section('content')
<div class="container">
    <h2>Category Details</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $category->name }}</h5>
            <p class="card-text"><strong>Status:</strong> {{ $category->status }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $category->description }}</p>
            <p class="card-text">
                <strong>Image:</strong><br>
                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" style="max-width: 100%; height: auto;">
            </p>
            <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
            </form>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
