@extends('super_admin.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Restaurant</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('admin.restaurants.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $restaurant->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Location:</strong>
            {{ $restaurant->city }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12php artisan serve

        <div class="form-group">
            <strong>Location:</strong>
            {{ $restaurant->phone }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Slug:</strong>
            {{ $restaurant->slug }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>URL:</strong>
            {{url($restaurant->slug)}}
        </div>
    </div>
</div>
@endsection
