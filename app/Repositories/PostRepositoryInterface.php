<?php

namespace App\Repositories;
use App\Models\Post;

interface PostRepositoryInterface
{
    public function getLatestPostsWithPagination(int $pagination);
    public function updatePost(array $postData): void;
    public function checkPostWithSlugExists(string $slug): bool;
}
