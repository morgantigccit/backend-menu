{{-- resources/views/admin/subscriber/index.blade.php --}}

@extends('layouts_admin.app')

@section('title', 'Subscribers List')

@section('content')
<h1 style="text-align: center; color: #4A4A4A;">Subscribers</h1>
<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background-color: #f8f9fa;">
            <th style="padding: 8px; border-bottom: 2px solid #dee2e6;">ID</th>
            <th style="padding: 8px; border-bottom: 2px solid #dee2e6;">Email</th>
            <th style="padding: 8px; border-bottom: 2px solid #dee2e6;">Name</th>
            <th style="padding: 8px; border-bottom: 2px solid #dee2e6;">Restaurant Name</th>
            <th style="padding: 8px; border-bottom: 2px solid #dee2e6;">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subscribers as $subscriber)
        <tr>
            <td style="text-align: left; padding: 8px; border-bottom: 1px solid #eee;">{{ $subscriber->id }}</td>
            <td style="text-align: left; padding: 8px; border-bottom: 1px solid #eee;">{{ $subscriber->email }}</td>
            <td style="text-align: left; padding: 8px; border-bottom: 1px solid #eee;">{{ $subscriber->name }}</td>
            <td style="text-align: left; padding: 8px; border-bottom: 1px solid #eee;">{{ $subscriber->restaurant_name }}</td>
            <td style="text-align: left; padding: 8px; border-bottom: 1px solid #eee;">
                <a href="{{ route('admin.subscribers.show', $subscriber->id) }}" style="color: #007bff; text-decoration: none;">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
