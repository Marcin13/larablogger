@extends('layouts.master')
@section('title','Posts')
@section('content')
    @if($posts->count() > 0)
        @foreach($posts as $post)
            @if($post->type == 'text')
    <article class="post formatText">
        <div class="postContent">
            <div class="wrapper">
                <h2 class="postTitle">
                    <a href="{{ route('posts.single',$post->slug) }}">{{ $post->title }}</a>
                </h2>
                <div class="rte">{{$post->Excerpt}}
                    <p class="readMore">
                        <a href="{{ route('posts.single',$post->slug) }}">Keep reading</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="meta">
            <ul class="tags">
                <li><i class="fa fa-tags"></i></li>
                <li>
                    <a href="#">format</a>
                </li>
                <li>
                    <a href="#">typography</a>
                </li>
            </ul>
            <div class="flex flex-sb">
                <p class="date"><i class="fa fa-clock-o"></i> {{$post->date->diffForHumans() }}</p>
                <p>
                    <a href="#" class="link"><i class="fa fa-edit"></i> Edytuj</a>
                </p>
            </div>
        </div>
    </article>
            @elseif($post->type == 'photo')
    <article class="post formatPhoto">
        <h2 class="postTitle">{{ $post->title }}</h2>
        <figure class="postImage">
            <i class="postPremium fa fa-star"></i>
            <a href="{{ route('posts.single',$post->slug) }}">
                <img src="{{ $post->image }}" alt="" class="mainPhoto">
            </a>
            <div class="cover"
                 style="">
            </div>
        </figure>
        <div class="meta">
            <ul class="tags">
                <li><i class="fa fa-tags"></i></li>
                <li>
                    <a href="#">photo</a>
                </li>
                <li>
                    <a href="#">dog</a>
                </li>
            </ul>
            <div class="flex flex-sb">
                <p class="date"><i class="fa fa-clock-o"></i> {{$post->date->diffForHumans()}}</p>
                <p>
                    <a href="#" class="link"><i class="fa fa-edit"></i> Edytuj</a>
                </p>
            </div>
        </div>
    </article>
    @endif
    @endforeach
        @include('partials.pagination', ['pagination'=> $posts] )
    @else
    <div class="wrapper">
        <p>Nie odnaleziono jeszcze żadnych wpisów</p>
    </div>
    @endif
@endsection
