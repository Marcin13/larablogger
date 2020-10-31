@extends('layouts.master')
@section('title', 'Reset Password')

@section('content')
    <div class="wrapper">
        <div class="rte">
            <h1>Reset password</h1>
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
