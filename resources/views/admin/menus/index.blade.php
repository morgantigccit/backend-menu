@extends('layouts_admin.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Menu Items</h2>
    <div class="mb-3">
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">Add New Menu Item</a>
    </div>

    <div class="row">
        @foreach ($menuItems as $menuItem)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset($menuItem->image) }}" class="card-img-top" alt="{{ $menuItem->name }}" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $menuItem->name }}</h5>
                    <p class="card-text">{{ $menuItem->category->name }}</p>
                    <p class="card-text">${{ number_format($menuItem->price, 2) }}</p>
                    <a href="{{ route('admin.menus.edit', $menuItem->MenuItemID) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('admin.menus.destroy', $menuItem->MenuItemID) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {!! $menuItems->links() !!}
    </div>
</div>
@endsection
