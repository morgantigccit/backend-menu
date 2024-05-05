@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #424874, #49a09d); /* Updated gradient background to include the dark blue */
        color: #fff;
        font-family: 'Arial', sans-serif;
    }

    .form-signin {
        width: 100%;
        max-width: 350px;
        padding: 15px;
        margin: auto;
        background-color: #F4EEFF; /* Light lavender for form background */
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .card {
        border: none;
        background: none;
    }

    .card-body {
        padding: 2rem;
    }

    .card-title {
        color: #424874; /* Dark blue for text */
        text-align: center;
        margin-bottom: 20px;
    }

    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
        background: none;
    }

    .form-label-group > input,
    .form-label-group > label {
        height: 3.5rem;
        padding: 10px 15px;
    }

    .form-label-group > label {
        position: absolute;
        top: 0;
        left: 0;
        color: #424874; /* Dark blue for the label */
        transition: all 0.2s ease;
    }

    .form-label-group input:not(:placeholder-shown) ~ label {
        top: -25px;
        font-size: 12px;
        color: #DCD6F7; /* Lighter purple when the label moves up */
    }

    .btn-login {
        width: 100%;
        background-color: #424874; /* Dark blue for button */
        border: none;
        padding: 10px;
        border-radius: 5px;
        color: #F4EEFF; /* Light lavender text */
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #DCD6F7; /* Lighter purple for hover */
    }

    .text-center a {
        color: #F4EEFF; /* Light lavender for links */
        text-decoration: none;
    }

    .text-center a:hover {
        text-decoration: underline;
        color: #424874; /* Dark blue for hover on links */
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ __('Login') }}</h2>
                    <form method="POST" action="{{ route('login') }}" class="form-signin">
                        @csrf
                        <div class="form-label-group">
                            <input id="email" type="email" class="form-control w-100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder=" ">
                            <label for="email">{{ __('Email Address') }}</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-label-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder=" ">
                            <label for="password">{{ __('Password') }}</label>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                            </label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-login" type="submit">{{ __('Login') }}</button>

                        @if (Route::has('password.request'))
                            <a class="d-block text-center mt-2 small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
