{{-- resources/views/admin/subscriber/email.blade.php --}}

@extends('layouts_admin.app')

@section('title', 'Send Email to Subscribers')

@section('content')
<style>
    .email-form-container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        border-radius: 8px;
    }

    .email-form h1 {
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: inline-block;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 10px;
        border-radius: 4px;
        margin-top: 20px;
    }
</style>

<div class="email-form-container">
    <h2>Send Email to All Subscribers</h2>
    <form action="{{ route('admin.subscribers.email.send') }}" method="POST" class="email-form">
        @csrf
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" required class="form-control">
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea name="message"  id="message" required class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif
</div>
@endsection
