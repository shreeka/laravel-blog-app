<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {

    }

    public function create()
    {
        $this->authorize('create',Post::class);
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $current_user = Auth::user();
        $data[] = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'image' => $request->image ?? 'NULL',
            'content' => $request->post_content,
            'author' => $current_user->username,
            'slug' => Str::slug($request->title),
        ];

        $this->postRepository->insertNewPost($data);
        return redirect('/show-post');

    }

    public function show(Post $post)
    {
        return view('posts.show');
    }


}
