{{-- resources/views/admin/menus/show.blade.php --}}

@extends('layouts_admin.app')



@section('content')
<div class="container">
    <h2>Menu Item Details</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $menuItem->name }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $menuItem->description }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ $menuItem->price }}</p>
            <p class="card-text"><strong>Category:</strong> {{ $menuItem->category->name }}</p>
            <p class="card-text">
                <strong>Image:</strong><br>
                <img src="{{ asset($menuItem->image) }}" alt="{{ $menuItem->name }}" style="max-width: 100%; height: auto;">
            </p>
            <a href="{{ route('admin.menus.edit', $menuItem->MenuItemID) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('admin.menus.destroy', $menuItem->MenuItemID) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this menu item?');">Delete</button>
            </form>
            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection
