@extends('layouts.master')
@section('title', 'Login')

@section('content')
    <div class="wrapper">
        <div class="rte">
            <h1>Login</h1>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Your e-mail" value="{{ old('email') }}">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="Password">
                </label>
            </div>
            <button class="button">Submit</button>
        </form>

        <div class="rte mt">
            <p>Don't have an account? <a href="{{ route('register') }}">Register now.</a><br>Forgot
                your password? <a href="#">Reset it here.</a></p>
        </div>
    </div>
@endsection
