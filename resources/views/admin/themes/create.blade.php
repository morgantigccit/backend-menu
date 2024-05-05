{{-- resources/views/admin/themes/create.blade.php --}}
@extends('layouts_admin.app')

@section('content')
<div class="container">
    <h2>Create Theme</h2>
    <form action="{{ route('admin.themes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection

{{-- Use a similar structure for edit.blade.php but pre-fill values and change the form action --}}
