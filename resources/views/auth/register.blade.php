@extends('layouts.master')
@section('title', 'Register')

@section('content')
    <div class="wrapper">
        <div class="rte">
            <h1>Register</h1>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Your e-mail" value="{{ old('email') }}">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name" placeholder="Your name" value="{{ old('name') }}" >
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" placeholder="Password" value="{{ old('password') }}">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field" type="password" name="password_confirmation"
                           placeholder="Repeat password">
                </label>
            </div>
            <button class="button">Submit</button>
        </form>
    </div>
@endsection
