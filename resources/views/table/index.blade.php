@extends('layouts.app') <!-- Assuming you have a layout file, adjust as needed -->

@section('content')
    <h1>Tables</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Table Number</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tables as $table)
                <tr>
                    <td>{{ $table->id }}</td>
                    <td>{{ $table->table_number }}</td>
                    <td>{{ $table->status }}</td>
                    <td>
                        <!-- Example: Button to update table status -->
                        <form method="POST" action="{{ route('table.update', $table->id) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status">
                                <option value="available" {{ $table->status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="occupied" {{ $table->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                <!-- Add other status options as needed -->
                            </select>
                            <button type="submit">Update Status</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
