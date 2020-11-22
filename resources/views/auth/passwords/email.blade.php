@extends('layouts.master')
@section('title', 'Reset Password')

@section('content')
    <div class="wrapper">
        <div class="rte">
            <h1>Reset password</h1>
            <p>Lost your password? Please enter your email address. You will receive a link to create a new password via email.</p>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Your e-mail">
                </label>
            </div>
            <button class="button">Submit</button>
        </form>
    </div>
@endsection
