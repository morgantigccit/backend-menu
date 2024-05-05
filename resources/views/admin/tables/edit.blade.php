{{-- resources/views/admin/tables/edit.blade.php --}}
@extends('layouts_admin.app')

@section('content')
<div class="container">
    <h2>Edit Table</h2>
    <form action="{{ route('admin.table.update', $table->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="TableNumber">Table Number</label>
            <input type="text" class="form-control" id="TableNumber" name="TableNumber" value="{{ $table->TableNumber }}" required>
        </div>
        <div class="form-group">
            <label for="Status">Status</label>
            <select id="Status" class="form-control" name="Status">
                <option value="Available" {{ $table->Status == 'Available' ? 'selected' : '' }}>Available</option>
                <option value="Occupied" {{ $table->Status == 'Occupied' ? 'selected' : '' }}>Occupied</option>
                <option value="Reserved" {{ $table->Status == 'Reserved' ? 'selected' : '' }}>Reserved</option>
                <option value="Out of Service" {{ $table->Status == 'Out of Service' ? 'selected' : '' }}>Out of Service</option>
            </select>
        </div>

        {{-- Add dropdown for assigning waiters --}}
        <div class="form-group">
            <label for="waiter_id">Assigned Waiter</label>
            <select class="form-control" id="waiter_id" name="waiter_id">
                <option value="">Select Waiter</option>
                @foreach ($waiters as $waiter)
                    <option value="{{ $waiter->id }}" {{ (isset($table->waiter_id) && $table->waiter_id == $waiter->id) ? 'selected' : '' }}>{{ $waiter->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
