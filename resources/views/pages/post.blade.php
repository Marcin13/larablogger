@extends('layouts.master')
@section('title', $post->title)

@section('content')
    @if($post->type === 'text')
        <article class="post formatText">
            <div class="postContent">
                <div class="wrapper">
                    @if($post->premium)
                        <i class="postPremium fa fa-star"></i>
                    @endif
                    <h2 class="postTitle">{{ $post->title }}</h2>
                    <div class="rte">
                        {!! $post->content !!}
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
                    <p class="date"><i class="fa fa-clock-o"></i> {{ $post->date->diffForHumans() }}</p>
                    <p>
                        <a href="{{ route('admin.post.edit',$post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
                    </p>
                </div>
            </div>
        </article>
    @elseif($post->type === 'photo')
        <article class="post formatPhoto">
            <figure class="postImage">
                @if($post->premium)
                    <i class="postPremium fa fa-star"></i>
                @endif
                <img src={{ asset($post->photo) }} alt="" class="mainPhoto" alt="">
                <div class="cover"
                     style="background: url({{ $post->photo }}) no-repeat;">
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
                    <p class="date"><i class="fa fa-clock-o"></i> {{ $post->date->diffForHumans() }}</p>
                    <p>
                        <a href="{{ route('admin.post.edit',$post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a>
                    </p>
                </div>
            </div>
        </article>
    @endif
    <section class="comments">
        <div class="wrapper">
            @if($post->comments->count() > 0)
                <div class="rte">
                    <h2>{{ $post->comments->count() }} {{ $post->comments->count() > 1 ? 'Comments' : 'Comment' }}</h2>
                </div>
                <div class="comments-list">
                    @foreach($post->comments as $comment)
                        <article class="comment">
                            <div class="comment-meta">
                                <img src="/images/avatar.jpg{{-- Gravatar::src($comment->author->email, 100) --}}" alt="{{-- $comment->author->name --}}" class="comment-avatar">
                                <span class="comment-user">{{ $comment->author->name }}</span>
                                <span class="comment-date">{{ $comment->date->format('d.m.Y') }}</span>
                            </div>
                            <p class="comment-body rte">{{ $comment->content }}</p>
                        </article>
                    @endforeach
                </div>
            @endif
            <div class="comments-add">
                <div class="rte">
                    <h2>Add comment</h2>
                </div>
                <form method="POST" action="{{ route('comment.create') }}">
                    @csrf

                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <div class="form-fieldset is-full">
                        <label>
                            <textarea name="content" class="form-textarea{{ $errors->has('content') ? ' is-invalid' : '' }}" placeholder="Your comment">{{ old('content') }}</textarea>
                        </label>
                    </div>
                    <button class="button">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
