@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <form method="post" action="/new-post">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="image">Image link</label>
                    <input type="text" class="form-control" id="image" name="image" placeholder="Enter image link">
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="post_content" placeholder="Write your content.."></textarea>
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

                <button type="submit" class="btn btn-primary mt-3">Publish</button>
            </form>
        </div>
    </div>
@endsection
