<!-- resources/views/menus/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Menu Item Details</h1>

    <ul>
        <li><strong>Name:</strong> {{ $menu->Name }}</li>
        <li><strong>Description:</strong> {{ $menu->Description }}</li>
        <li><strong>Price:</strong> {{ $menu->Price }}</li>
        <li><strong>Category:</strong> {{ $menu->Category }}</li>
        <li><strong>Image:</strong> <img src="{{ asset('images/'.$menu->Image) }}" alt="{{ $menu->Name }}" width="200"></li>
    </ul>

    <a href="{{ route('menus.edit',$menu->MenuItemID) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('menus.destroy', $menu->MenuItemID) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>

    <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back to Menu Items</a>
@endsection
