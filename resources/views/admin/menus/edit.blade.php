{{-- resources/views/admin/menus/edit.blade.php --}}
@extends('layouts_admin.app')



@section('content')
<div class="container">
    <h2 class="mb-5">Edit Menu Item</h2>
    <form action="{{ route('admin.menus.update', $menuItem->MenuItemID) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->category_id }}" {{ $menuItem->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $menuItem->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $menuItem->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $menuItem->price }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image"><br>
            <img src="{{ asset($menuItem->image) }}" alt="{{ $menuItem->name }}" style="max-width: 100px; height: auto;">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
