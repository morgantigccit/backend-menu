{{-- resources/views/admin/users/edit.blade.php --}}

@extends('super_admin.app')


@section('content')
<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="user" @if(old('role', $user->role) == 'user') selected @endif>User</option>
                <option value="admin" @if(old('role', $user->role) == 'admin') selected @endif>Admin</option>
                <!-- Add more roles as necessary -->
            </select>
        </div>

        <div class="mb-3">
            <label for="restaurant_name" class="form-label">Restaurant Name (optional)</label>
            <input type="text" class="form-control" id="restaurant_name" name="restaurant_name" value="{{ old('restaurant_name', $user->restaurant_name) }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password (Leave blank to not change)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
