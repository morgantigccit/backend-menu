<!-- resources/views/menus/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Menu Item</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="{{ $menu->Name }}" required>
        <br>
        <label for="Description">Description:</label>
        <textarea name="Description" required>{{ $menu->Description }}</textarea>
        <br>
        <label for="Price">Price:</label>
        <input type="text" name="Price" value="{{ $menu->Price }}" required>
        <br>
        <label for="Category">Category:</label>
        <input type="text" name="Category" value="{{ $menu->Category }}" required>
        <br>
        <label for="Image">Image:</label>
        <input type="file" name="Image" accept="image/*">
        <br>
        <img src="{{ asset('images/'.$menu->Image) }}" alt="{{ $menu->Name }}" width="100">
        <br>
        <button type="submit">Update</button>
    </form>
@endsection
