@extends('layouts.master')
@section('title', 'Verify Your Email')

@section('content')
    <div class="wrapper">
        <div class="rte">
            <h1>Verify Your Email</h1>
        </div>

        <div class="rte mt">
            <p>Didn't get an email? <a href="{{ route('verification.resend') }}">Request another.</a></p>
        </div>
    </div>
@endsection
