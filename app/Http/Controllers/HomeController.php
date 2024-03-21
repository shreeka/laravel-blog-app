<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepositoryInterface;

class HomeController extends Controller
{
    public function __construct(private PostRepositoryInterface $postRepository)
    {

    }
    public function index()
    {
        $posts = $this->postRepository->getLatestPostsWithPagination(4);
        return view('home.index',['posts' => $posts]);
    }
}
