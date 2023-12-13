<?php

namespace App\Http\Controllers\Page;

use App\Contracts\Repositories\PostRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterPostRequest;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }


    /**
     * Get all posts
     * @param \App\Http\Requests\Post\FilterPostRequest $query
     * @return \Illuminate\View\View
     */
    public function index(FilterPostRequest $query): View
    {
        return view('pages.blog.index', [
            'posts' => $this->postRepository->getAllPosts(9, $query->validated())
        ]);
    }

    /**
     * Get a post
     * 
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        return view('pages.blog.show', [
            'post' => $this->postRepository->getPost($slug)
        ]);
    }
}
