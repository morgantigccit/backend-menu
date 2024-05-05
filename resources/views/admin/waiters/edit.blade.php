@extends('layouts_admin.app')


@section('content')
<div class="container">
    <h1>Edit Waiter</h1>
    <form action="{{ route('admin.waiters.update', $waiter->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $waiter->name }}" required>
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ $waiter->position }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
