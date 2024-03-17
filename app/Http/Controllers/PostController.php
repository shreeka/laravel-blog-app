<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use DateTime;
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
        $slug = Str::slug($request->title);

        //Check if slug already exists
        $slug_exists = Post::where('slug', $slug)->exists();
        if($slug_exists) {
            $slug = $slug.'-'.uniqid();
        }

        $data[] = [
            'user_id' => Auth::id(),
            'title' => $request->title,
            'image' => $request->image ?? 'NULL',
            'content' => $request->post_content,
            'author' => $current_user->username,
            'slug' => $slug,
        ];

        $this->postRepository->insertNewPost($data);
        return redirect()->route('posts.show',['slug'=> $slug]);

    }

    public function show(String $slug)
    {
        $post = $this->postRepository->getPostBySlug($slug);
        if ($post) {
            $postedDate = new DateTime($post->created_at);
            $updatedDate = new DateTime($post->updated_at);
            $postedDate = $postedDate->format('M d, Y');
            $updatedDate = $updatedDate->format('M d, Y');

            $postData = [
                'postedDate' => $postedDate,
                'updatedDate' => $updatedDate
            ];

            return view('posts.show')->with([
                'post' => $post,
                'postData' => $postData
                ]);
        }else {
            return view('error.notfound');
        }

    }


}
