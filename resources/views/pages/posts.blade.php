@extends('layouts.master')
@section('title','Posts')
@section('content')
    @if($posts->count() > 0)
        @foreach($posts as $post)
            @if($post->type == 'text')
    <article class="post formatText">
        <div class="postContent">
            <div class="wrapper">
                @if($post->premium)
                    <i class="postPremium fa fa-star"></i>
                @endif
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
            @if($post->tags->count() > 0)
                <ul class="tags">
                    <li><i class="fa fa-tags"></i></li>
                    @foreach($post->tags as $tag)
                        <li>
                            <a href="{{route('posts.tags', $tag->slug)}}">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="flex flex-sb">
           {{--     <p class="date"><i class="fa fa-clock-o"></i> {{$post->date->diffForHumans() }} <i class="fa fa-user"></i> by {{ $post->author->name }} </p> --}}
                <p class="date"><i class="fa fa-clock-o"></i> {{$post->date->diffForHumans() }} <i class="fa fa-user"></i>
                    by <a href="{{route('user.profile', $post->author->name)}}">{{ $post->author->name }}</a> </p>
                <p>
                    <a href="{{ route('admin.post.edit',$post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
                </p>
            </div>
        </div>
    </article>
            @elseif($post->type == 'photo')
    <article class="post formatPhoto">
        <h2 class="PhotoPostTitle" ><a href="{{ route('posts.single',$post->slug) }}">{{ $post->title }}</a></h2>
        <figure class="postImage">
            @if($post->premium)
                <i class="postPremium fa fa-star"></i>
            @endif
            <a href="{{ route('posts.single',$post->slug) }}">
                <img src="{{ asset($post->photo) }}" alt="" class="mainPhoto">
            </a>
                <div class="wrapper content">
                <div class="readMore">{{$post->Excerpt}}
                    <p class="readMore">
                        <a href="{{ route('posts.single',$post->slug) }}">Keep reading</a>
                    </p>
                </div>
                </div>
        </figure>
        <div class="meta">
            @if($post->tags->count() > 0)
                <ul class="tags">
                    <li><i class="fa fa-tags"></i></li>
                    @foreach($post->tags as $tag)
                        <li>
                            <a href="{{route('posts.tags', $tag->slug)}}">{{ $tag->name }}</a>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="flex flex-sb">
                <p class="date"><i class="fa fa-clock-o"></i> {{$post->date->diffForHumans() }} <i class="fa fa-user"></i>
                    by  <a href="{{route('user.profile', $post->author->name)}}">{{ $post->author->name }}</a> </p>
                <p>
                <p>
                    <a href="{{ route('admin.post.edit',$post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
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
