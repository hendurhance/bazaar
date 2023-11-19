<?php

namespace App\Http\Controllers\Admin\Post;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected CommentRepositoryInterface $commentRepository, protected AuthenticateRepositoryInterface $authenticateRepository)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * @param \App\Http\Requests\Post\CreateCommentRequest $request
     * @param string $slug
     */
    public function store(CreateCommentRequest $request, string $slug)
    {
        $this->commentRepository->storeComment($request->validated(), $slug, $this->authenticateRepository->admin());
        return redirect()->route('admin.blogs.show', $slug)->with('success', 'Comment created successfully.');
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
