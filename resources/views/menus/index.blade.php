<!-- resources/views/menus/index.blade.php -->

@extends('layouts_admin.app')

@section('content')
    <h1>Menu Items</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
                <tr>
                    <td>{{ $menu->Name }}</td>
                    <td>{{ $menu->Description }}</td>
                    <td>{{ $menu->Price }}</td>
                    <td>{{ $menu->Category }}</td>
                    <td>
                        <img src="{{ asset('images/'.$menu->Image) }}" alt="{{ $menu->Name }}" width="50">
                    </td>
                    <td>
                        <a href="{{ route('menus.show', $menu->MenuItemID) }}" class="btn btn-info">View</a>
                        <a href="{{ route('menus.edit', $menu->MenuItemID) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->MenuItemID) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('menus.create') }}" class="btn btn-success">Add Menu Item</a>
@endsection
