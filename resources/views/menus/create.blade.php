<!-- resources/views/menus/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Create Menu Item</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="Name">Name:</label>
        <input type="text" name="Name" required>
        <br>
        <label for="Description">Description:</label>
        <textarea name="Description" required></textarea>
        <br>
        <label for="Price">Price:</label>
        <input type="text" name="Price" required>
        <br>
        <label for="Category">Category:</label>
        <input type="text" name="Category" required>
        <br>
        <label for="Image">Image:</label>
        <input type="file" name="Image" accept="image/*" required>
        <br>
        <button type="submit">Create</button>
    </form>
@endsection
