<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

final class PostRepository implements PostRepositoryInterface
{

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
