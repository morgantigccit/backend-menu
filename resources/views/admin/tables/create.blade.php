{{-- resources/views/admin/tables/create.blade.php --}}
@extends('layouts_admin.app')

@section('content')
    <div class="container">
        <h2>Add New Table</h2>
        <form action="{{ route('admin.table.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="TableNumber">TableNumber</label>
                <input type="text" class="form-control" id="TableNumber" name="TableNumber" required>
            </div>
            <div class="form-group">
                <label for="Status">Status</label>
                <select id="Status" class="form-control" name="Status">
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                    <option value="Reserved">Reserved</option>
                    <option value="Out of Service">Out of Service</option>
                </select>
            </div>

            {{-- Add dropdown for assigning waiters --}}
            <div class="form-group">
                <label for="waiter_id">Assign Waiter</label>
                <select class="form-control" id="waiter_id" name="waiter_id">
                    <option value="">Select Waiter</option>
                    @foreach ($waiters as $waiter)
                        <option value="{{ $waiter->id }}">{{ $waiter->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
