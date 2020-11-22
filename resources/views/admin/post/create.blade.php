@extends('layouts.master')
@section('title', 'Create New Post')

@section('content')
    <div class="wrapper">
        <div class="wrapper">
            <div class="rte">
                <h1>Create new post</h1>
            </div>

            <form method="POST" action="{{ route('admin.post.create') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-fieldset">
                    <label>
                        <input class="form-field{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" placeholder="Title" value="{{ old('title') }}">
                    </label>
                </div>
                <div class="form-fieldset">
                    <div class="form-select{{ $errors->has('type') ? ' is-invalid' : '' }}">
                        <label>
                            <select name="type">
                                <option value="" disabled selected>Choose Type</option>
                                <option value="text">Type: Text</option>
                                <option value="photo">Type: Photo</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Date:</label>
                    <label>
                        <input class="form-field{{ $errors->has('date') ? ' is-invalid' : '' }}" type="date" name="date">
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Tags:</label>
                    <label>
                        <input class="form-field" type="text" name="tags" value="{{ old('tags') }}">
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Published:</label>
                    <label>
                        <input type="checkbox" name="published" value="1">
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label">Premium:</label>
                    <label>
                        <input type="checkbox" name="premium" value="1">
                    </label>
                </div>
                <div class="form-fieldset">
                    <label class="form-label {{ $errors->has('image') ? ' is-invalid' : '' }}">Image:</label>
                    <input type="file" name="image" value="{{ old('image') }}">
                </div>
                <div class="form-fieldset is-full">
                    <label for="wysiwyg"></label><textarea id="wysiwyg" class="form-textarea" name="content" placeholder="Content">{{ old('content') }}</textarea>
                </div>
                <button class="button">Add post</button>
            </form>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ mix('/js/main.js') }}"></script>
@endsection
