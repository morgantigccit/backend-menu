{{-- resources/views/admin/themes/index.blade.php --}}
@extends('layouts_admin.app')


@section('content')
<div class="container mt-4">
    <h1>Themes</h1>
    <a href="{{ route('admin.themes.create') }}" class="btn btn-primary">Create New Theme</a>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($themes as $theme)
                <tr>
                    <td>{{ $theme->name }}</td>
                    <td>{{ $theme->description }}</td>
                    <td>{{ $theme->is_active ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('admin.themes.edit', $theme->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('admin.themes.destroy', $theme->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="{{ route('admin.themes.activate', $theme->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Activate</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
