<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class PostRepository implements PostRepositoryInterface
{

    public function insertNewPost(array $post_data): void
    {
        try {
            $post = new Post();
            $post->user_id = $post_data['user_id'];
            $post->title = $post_data['title'];
            $post->image = $post_data['image'];
            $post->content = $post_data['content'];
            $post->author = $post_data['author'];
            $post->slug = $post_data['slug'];

            $post->save();
        }
        catch (\Throwable $exception) {
            Log::error('Error inserting new post: '. $exception->getMessage());
        }

    }

    public function getPostBySlug(string $slug): ?Post
    {
        $post = Post::where('slug',$slug)->first();
        return $post;

    }

    public function getLatestPostsWithPagination(int $pagination)
    {
        $posts = DB::table('posts')->orderBy('created_at','desc')->paginate($pagination);
        return $posts;
    }

    public function updatePost(array $postData): void
    {
       $post = $this->getPostBySlug($postData['current_slug']);
       if ($post){
           try {
               $post->title = $postData['title'];
               $post->image = $postData['image'];
               $post->content = $postData['content'];
               $post->slug = $postData['slug'];

               $post->save();

           }
           catch (\Throwable $exception) {
               Log::error('Error updating post:', [$exception->getMessage()]);
           }
       }
    }

    /**
     * @param string $slug
     * @return bool
     */
    public function checkPostWithSlugExists(string $slug): bool
    {
        return Post::where('slug', $slug)->exists();
    }
}
