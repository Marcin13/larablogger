@extends('layouts.master')
@section('title', 'User profile')

@section('content')
    <div class="wrapper">
        <div class="wrapper">
            <div class="rte">
                <h1>User details</h1>
            </div>
            <div>
                <h3>
                  Name: {{$user->name}}
                </h3>
            </div>
            <div>
                <h3>Email: {{$user->email}}</h3>
            </div>
            <div>
                <h3>Verified at: {{$user->email_verified_at ? $user->email_verified_at->format('Y-m-d'): "User not verified"}}</h3>
            </div>
            <div>
                <h3>Created at: {{$user->created_at->format('Y-m-d')}}</h3>
            </div>

        </div>
    </div>
@endsection


