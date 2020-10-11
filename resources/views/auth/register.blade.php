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
                    <input class="form-field" type="email" name="email" placeholder="Your e-mail">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field" type="text" name="name" placeholder="Your name">
                </label>
            </div>
            <div class="form-fieldset">
                <label>
                    <input class="form-field" type="password" name="password" placeholder="Password">
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
