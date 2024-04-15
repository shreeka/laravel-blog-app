<?php

namespace App\Http\Controllers;

use App\Helpers\PostContentHelper;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
        $slug = $this->getUniqueSlug($slug);

        $data = [
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
            $postData = [
                'postedDate' => PostContentHelper::formatPostDate($post->created_at),
                'updatedDate' => PostContentHelper::formatPostDate($post->updated_at)
            ];
            return view('posts.show')->with([
                'post' => $post,
                'postData' => $postData
                ]);
        }else {
            return view('error.notfound');
        }

    }

    public function edit(String $slug)
    {
        $this->authorize('edit', Post::class);
        $post = $this->postRepository->getPostBySlug($slug);
        return view('posts.edit')->with(['post'=> $post]);

    }

    public function update(UpdatePostRequest $request)
    {
        $current_slug = $request->slug;
        $updated_slug = Str::slug($request->title);

        //If post title has been updated, slug needs to be updated
        if($current_slug != $updated_slug) {
            $slug = $this->getUniqueSlug($updated_slug);
        }else {
            $slug = $current_slug;
        }

        $data = [
            'title' => $request->title,
            'image' => $request->image ?? 'NULL',
            'content' => $request->post_content,
            'current_slug' => $current_slug,
            'slug' => $slug,
        ];
        $this->postRepository->updatePost($data);
        return redirect()->route('posts.show',['slug' => $slug]);

    }

    public function destroy(Post $post)
    {
        if($post->delete()) {
            return redirect('/home')->with('success','Post deleted sucessfully.');
        }else {
            return redirect()->back()->with('error','Failed to delete post.');
        }

    }

    /**
     * @param string $slug
     * @return string
     */
    private function getUniqueSlug(string $slug): string
    {
        $slug_exists = $this->postRepository->checkPostWithSlugExists($slug);
        if ($slug_exists) {
            $slug = $slug . '-' . uniqid();
        }
        return $slug;
    }




}
