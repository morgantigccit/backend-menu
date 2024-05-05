@extends('super_admin.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Restaurants Management</h2>
        </div>
        <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('admin.restaurants.create') }}"> Create New Restaurant</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Location</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($restaurants as $restaurant)
    <tr>
        <td>{{  $restaurant->id }}</td>
        <td>{{ $restaurant->name }}</td>
        <td>{{ $restaurant->address }}</td>
        <td>
            <form action="{{ route('admin.restaurants.destroy',$restaurant->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('admin.restaurants.show',$restaurant->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('admin.restaurants.edit',$restaurant->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{-- {!! $restaurants->links() !!} --}}
@endsection
