<?php

namespace App\Http\Controllers\Admin\Post;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\FilterAdminPostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected PostRepositoryInterface $postRepository, protected AuthenticateRepositoryInterface $authenticateRepository)
    {}

    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\Post\FilterAdminPostRequest $query
     * @return \Illuminate\View\View
     */
    public function index(FilterAdminPostRequest $query): View
    {
        return view('blogs.admin.index', [
            'posts' => $this->postRepository->getAllPostsForAdmin(10, $query->validated())
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('blogs.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \App\Http\Requests\Post\CreatePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $this->postRepository->createPost($request->validated(), $this->authenticateRepository->admin());
        return redirect()->route('admin.blogs.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug): View
    {
        return view('blogs.admin.show', [
            'post' => $this->postRepository->getPostForAdmin($slug)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function edit(string $slug): View
    {
        return view('blogs.admin.edit', [
            'post' => $this->postRepository->getPostForAdmin($slug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\Post\UpdatePostRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePostRequest $request, string $slug): RedirectResponse
    {
        $this->postRepository->updatePost($slug, $request->validated());
        return redirect()->route('admin.blogs.show', $slug)->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug): RedirectResponse
    {
        $this->postRepository->deletePost($slug);
        return redirect()->route('admin.blogs.index')->with('success', 'Post deleted successfully.');
    }
}
