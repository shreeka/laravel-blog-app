@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Blog entries-->
        <div>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6">
                        <div class="card mb-4" style="height: 513px">
                            <a href="/posts/{{ $post->slug }}">
                                @if($post->image == 'NULL')
                                    <img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                         alt="..."/>
                                @else
                                    <img class="card-img-top" src="{{ $post->image }}" alt="..."/>
                                @endif
                            </a>
                            <div class="card-body">
                                <div class="small text-muted">
                                    {{ \App\Helpers\PostContentHelper::formatPostDate($post->created_at) }}
                                </div>
                                <h2 class="card-title h4">{{ $post->title }}</h2>
                                <p class="card-text">
                                    {{ \App\Helpers\PostContentHelper::limitPostText($post->content,100) }}
                                </p>

                                <a class="btn btn-primary" href="#!">Read more →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Pagination-->
            {{ $posts->links() }}
        </div>
    </div>
@endsection
