<?php

namespace App\Http\Controllers\Page;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateCommentRequest;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected CommentRepositoryInterface $commentRepository, protected AuthenticateRepositoryInterface $authenticateRepository)
    {
        $this->middleware(['auth:web', 'ensure.email.verified'])->only('store');
    }

    /**
     * Store a comment
     * 
     * @param \App\Http\Requests\Post\CreateCommentRequest $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCommentRequest $request, string $slug): RedirectResponse
    {
        $this->commentRepository->storeComment($request->validated(), $slug, $this->authenticateRepository->user());

        return back()->with('success', 'Comment added successfully');
    }
}
