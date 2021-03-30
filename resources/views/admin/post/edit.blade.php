@extends('layouts.master')
@section('title', 'Edit Post')
@section('content')
    <div class="wrapper">
        <div class="wrapper">
            <div class="rte">
                <h1>Edit post</h1>
            </div>

            <form method="POST" action="{{ route('admin.post.edit', $post->id) }}" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                {{-- method_field('PUT') --}}

                <div class="form-fieldset">
                    <label>
                        <input class="form-field{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" placeholder="Title" value="{{ $post->title }}">
                    </label>
                </div>
                <div class="form-fieldset">
                    <div class="form-select{{ $errors->has('type') ? ' is-invalid' : '' }}">
                        <label>
                            <select name="type">
                                <option value="" disabled>Choose Type</option>
                                <option value="text"{{ $post->type === 'text' ? ' selected' : '' }}>Type: Text</option>
                                <option value="photo"{{ $post->type === 'photo' ? ' selected' : '' }}>Type: Photo</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Date:</label>
                    <label>
                        <input class="form-field{{ $errors->has('date') ? ' is-invalid' : '' }}" type="date" name="date" value="{{ $post->date->format('Y-m-d') }}">
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Tags:</label>
                    <label>
                        <input class="form-field{{ $errors->has('tags') ? ' is-invalid' : '' }}" type="text" name="tags" value="{{ $post->tags->implode('name', ' ') }}">
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Published:</label>
                    <label>
                        <input type="checkbox" name="published" value="1" {{ $post->published? 'checked':'' }}>
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Premium:</label>
                    <label>
                        <input type="checkbox" name="premium" value="1" {{ $post->premium? 'checked':'' }}>
                    </label>
                </div>
                <img alt="image" src="{{ $post->photo }}" class="form-image">
                <div class="form-fieldset">
                    <label class="form-label">Image:</label>
                    <input type="file" name="image">
                </div>
                <div class="form-fieldset is-full">
                    <label for="wysiwyg"></label><textarea id="wysiwyg" class="form-textarea" name="content" placeholder="Content">{{ $post->content }}</textarea>
                </div>
                <button class="button">Update</button>
            </form>
          {{-- <div class="">
            <a href="{{ route('admin.post.edit', $post->id+1) }}"{!! request()->routeIs('about') ? ' class="is-active"' : '' !!}>Next post</a>
            </div>--}}
            <div class="rte mt">
                <h1>Delete post</h1>
            </div>

            <form method="post" action="{{ route('admin.post.delete',$post->id) }}">
                @csrf
                {{ method_field('DELETE') }}
                <button class="button button--danger" onclick="return confirm('Are you sure you want to delete?')" >Delete post</button>
            </form>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ mix('/js/main.js') }}"></script>
@endsection
