{{-- resources/views/admin/subscriber/show.blade.php --}}

@extends('layouts_admin.app')

@section('title', 'Subscriber Details')

@section('content')
<style type="text/css">
/* Subscriber details container */
.subscriber-details-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
}

/* Styling for headers */
h1 {
    color: #333;
    font-size: 24px;
    text-align: center;
}

/* Box that contains detail labels and text */
.detail-box {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

.detail-box label {
    font-weight: bold;
    display: block;
    color: #666;
    margin-top: 10px;
}

.detail-box p {
    color: #333;
    margin: 5px 0 10px;
}

/* Buttons and links */
.bt
</style>
<div class="subscriber-details-container">
    <h1>Subscriber Details</h1>
    <div class="detail-box">
        <label>ID:</label>
        <p>{{ $subscriber->id }}</p>
        <label>Email:</label>
        <p>{{ $subscriber->email }}</p>
        <label>Name:</label>
        <p>{{ $subscriber->name }}</p>
        <label>Restaurant Name:</label>
        <p>{{ $subscriber->restaurant_name }}</p>
    </div>
    <a href="{{ route('admin.subscribers.index') }}" class="btn back-btn">Back to List</a>
</div>
@endsection
