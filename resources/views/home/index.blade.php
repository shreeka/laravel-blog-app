@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Blog entries-->
        <div>
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-6">
                        <div class="card mb-4">
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
            <nav aria-label="Pagination">
                <hr class="my-0"/>
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                    <li class="page-item"><a class="page-link" href="#!">15</a></li>
                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
