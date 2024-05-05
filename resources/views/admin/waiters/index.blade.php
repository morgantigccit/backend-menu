@extends('layouts_admin.app')


@section('content')
<div class="container">
    <h1>Waiters List</h1>
    <a href="{{ route('admin.waiters.create') }}" class="btn btn-primary">Add New Waiter</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Restaurant Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($waiters as $waiter)
                <tr>
                    <td>{{ $waiter->name }}</td>
                    <td>{{ $waiter->position }}</td>
                    <td>{{ $waiter->restaurant_name }}</td>
                    <td>
                        <a href="{{ route('admin.waiters.edit', $waiter->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.waiters.destroy', $waiter->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
