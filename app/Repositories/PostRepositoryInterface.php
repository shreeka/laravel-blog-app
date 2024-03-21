<?php

namespace App\Repositories;
use App\Models\Post;

interface PostRepositoryInterface
{
    public function insertNewPost(array $post_data): void;
    public function getPostBySlug(string $slug): Post;

    public function getLatestPostsWithPagination(int $pagination);
}
