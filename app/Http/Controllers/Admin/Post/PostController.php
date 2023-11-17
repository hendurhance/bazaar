<?php

namespace App\Http\Controllers\Admin\Post;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\FilterAdminPostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected PostRepositoryInterface $postRepository, AuthenticateRepositoryInterface $authenticateRepository)
    {}

    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\Post\FilterAdminPostRequest $query
     * @return \Illuminate\View\View
     */
    public function index(FilterAdminPostRequest $query)
    {
        return view('blogs.admin.index', [
            'posts' => $this->postRepository->getAllPostsForAdmin(10, $query->validated())
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
