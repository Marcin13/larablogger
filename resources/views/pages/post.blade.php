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
                    <p class="date"><i class="fa fa-clock-o"></i> {{ $post->date->diffForHumans() }}</p>
                    {{--Social media buttons--}}
                    @include('partials.social')
                    {{--Social media buttons--}}
                    @can('manage-posts')
                        <p><a href="{{ route('admin.post.edit',$post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a></p>
                    @endcan
                </div>
            </div>
            @include('partials.post.pagination');
        </article>
    @elseif($post->type === 'photo')
        <article class="post formatPhoto">
            <h2 class="PhotoPostTitle" >{{ $post->title }}</h2>
            <figure class="postImage">
                @if($post->premium)
                    <i class="postPremium fa fa-star"></i>
                @endif
                <img src={{ asset($post->photo) }} alt="" class="mainPhoto" alt="">
                <div class="cover"
                     style="background: url({{ $post->photo }}) no-repeat;">
                </div>
                    <div class="wrapper content">
                        <div class="readMore">{!! $post->content !!}
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
                        {{--Social media buttons--}}
                        @include('partials.social')
                        {{--Social media buttons--}}
                        @can('manage-posts')
                            <p><a href="{{ route('admin.post.edit',$post->id) }}" class="link"><i class="fa fa-edit"></i> Edytuj</a></p>
                        @endcan
                    </div>
            </div>
            @include('partials.post.pagination')
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
                                <img src="{{ Gravatar::src($comment->author->email, 100) }}"
                                     alt="{{$comment->author->name }}" class="comment-avatar">
                                {{--<span class="comment-user">{{ $comment->author->name }}</span> --}}
                                <span class="comment-user"><a
                                        href="{{route('user.profile', $comment->author->name)}}">{{ $comment->author->name }}</a></span>
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
                    <label>
                        <div class="form-fieldset is-full">
                            <textarea name="content"
                                      class="form-textarea{{ $errors->has('content') ? ' is-invalid' : '' }}"
                                      placeholder="Your comment">{{ old('content') }}</textarea>
                        </div>
                    </label>
                    <button class="button" id="scroll-to">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
