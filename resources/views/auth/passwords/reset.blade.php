@extends('layouts.master')
@section('title', 'Reset Password')

@section('content')
    <div class="wrapper">
        <div class="rte">
            <h1>Reset password</h1>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email" placeholder="Your e-mail" value="{{ old('email') }}">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" placeholder="New password">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" placeholder="New password again">
                </label>
            </div>
            <button class="button">Reset password</button>
        </form>
    </div>
@endsection
