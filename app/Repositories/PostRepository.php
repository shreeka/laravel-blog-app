<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostRepository implements PostRepositoryInterface
{

    public function insertNewPost(array $post_data): void
    {
        try {
            $post = new Post();
            $post->user_id = $post_data[0]['user_id'];
            $post->title = $post_data[0]['title'];
            $post->image = $post_data[0]['image'];
            $post->content = $post_data[0]['content'];
            $post->author = $post_data[0]['author'];
            $post->slug = $post_data[0]['slug'];

            $post->save();
        }
        catch (\Throwable $exception) {
            Log::error('Error inserting new post: '. $exception->getMessage());
        }

    }

    public function getPostBySlug(string $slug): Post
    {
        $post = Post::where('slug',$slug)->first();
        return $post;

    }

    public function getLatestPostsWithPagination(int $pagination)
    {
        $posts = DB::table('posts')->orderBy('created_at','desc')->paginate($pagination);
        return $posts;
    }
}
