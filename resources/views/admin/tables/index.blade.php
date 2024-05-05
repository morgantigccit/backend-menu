{{-- resources/views/admin/tables/index.blade.php --}}
@extends('layouts_admin.app')

@section('content')
<div class="container">
    <h2>Tables List</h2>
    <a href="{{ route('admin.table.create') }}" class="btn btn-primary">Add New Table</a>
    <table class="table">
        <thead>
            <tr>
                <th>Table Number</th>
                <th>Status</th>
                <th>Assigned Waiter</th> <!-- New column for assigned waiter -->
                <th>QR Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tables as $table)
            <tr>
                <td>{{ $table->TableNumber }}</td>
                <td>{{ $table->Status }}</td>
                <td>{{ $table->waiter->name ?? 'Not Assigned' }}</td> <!-- Display assigned waiter's name -->
                <td>
                    <!-- Inline QR Code Generation -->
                    {!! QrCode::size(100)->generate( url('https://ewaiter.netlify.app/'.$table->restaurant_name."/".$table->TableNumber)) !!}
                </td>
                <td>
                    <a href="{{ route('admin.table.edit', $table->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('admin.table.delete', $table->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
