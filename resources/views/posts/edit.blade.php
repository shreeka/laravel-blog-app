@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <form method="post" action= {{ route('posts.update') }}>
                @csrf
                <input type="hidden" name= "slug" value="{{ $post->slug }}">
                <div class="form-group">
                    <label for="title">Title </label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                           value="{{ $post->title }}">
                </div>
                <div class="form-group mt-2">
                    <label for="image">Header image URL</label>
                    <input type="text" class="form-control" id="image" name="image" placeholder="Enter image URL"
                    value="{{ $post->image }}">
                </div>
                <div class="form-group mt-3">
                    <input id="x" type="hidden" name="post_content" value="{{ $post->content }}">
                    <trix-editor input="x" class="trix-content" id = "content-editor"></trix-editor>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection
