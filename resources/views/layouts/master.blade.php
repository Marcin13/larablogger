<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--<!-- CSRF Token zapożyczony od app.blade -->--}}
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="none" onload="this.media='all'">--}}
     {{-- <link rel="stylesheet" href="/css/main.css"> --}}
    <!--for social media and fonts -->
    <script src="https://use.fontawesome.com/39143ff36e.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    {{--<script src="{{ asset('js/share.js') }}"></script>--}}
    <!--for social media -->
    <link rel="stylesheet" href="{{ mix('/css/main.css')}}">
    <title>@yield('title','Home') - {{ config('app.name') }}</title>
</head>
<body class="page-index">
@include('partials.message')
<div class="container">
    <header class="mainHeader">
        <div class="wrapper flex">
            <a href="{{ url('/') }}" class="logo">LaraBlogger</a>
            <nav>
                <ul>
                    <li><a href="{{ route('about') }}"{!! request()->routeIs('about') ? ' class="is-active"' : '' !!}>About me</a></li>
                    @auth
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    @else
                        <li><a href="{{ route('login') }}"{!! request()->routeIs('login') ? ' class="is-active"' : '' !!}>Login</a></li>
                    @endauth
                    @can('manage-posts')
                    <li><a href="{{ route('admin.post.create') }}"{!! request()->routeIs('admin.post.create') ? ' class="is-active"' : '' !!}>Create</a></li>
                    @endcan
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{route('feeds.main')}}">RSS <i class="fa fa-rss-square"></i></a></li>
                </ul>
            </nav>
            <form action="{{ route('search') }}" class="search">
                <div class="form-fieldset">
                    <label>
                        <input type="text" name="q" class="form-field" placeholder="Search..." value="{{ request()->get('q') }}">
                    </label>
                </div>
            </form>
        </div>
    </header>
    <section class="mainContent">
        @yield('content')
    </section>
    <footer class="mainFooter">
        <div class="wrapper">
            <p>&copy; {{ date('Y') }} LaraBlogger</p>
            <nav>
                <ul>
                    <li><a href="{{ route('about') }}"{!! request()->routeIs('about') ? ' class="is-active"' : '' !!}>About me</a></li>
                    @auth
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                    @else
                        <li><a href="{{ route('login') }}"{!! request()->routeIs('login') ? ' class="is-active"' : '' !!}>Login</a></li>
                    @endauth
                    <li><a href="{{route('contact') }}"{!! request()->routeIs('contact') ? ' class="is-active"' : '' !!}>Contact</a></li>
                    <li><a href="{{ route('feeds.main') }}">RSS</a></li>
                </ul>
            </nav>
            <p class="author">All rights reserved <a href="{{ url('/') }}">LaraBlogger</a></p>
        </div>
    </footer>
</div>
@auth
    <form id="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
    </form>

    <script>
      /*  document.querySelector("a[href='#logout']").addEventListener("click", function(e) {
            e.preventDefault();

            document.querySelector("#logout-form").submit();
        }, false);*/
    </script>
@endauth
@yield('footer_scripts')
</body>
</html>

