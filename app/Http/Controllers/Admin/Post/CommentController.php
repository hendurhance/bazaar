<?php

namespace App\Http\Controllers\Admin\Post;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreateCommentRequest;
use App\Http\Requests\Post\FilterAdminCommentRequest;
use App\Http\Requests\Post\UpdateCommentRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * 
     * @return \Illuminate\View\View
     */
    public function index(FilterAdminCommentRequest $query): View
    {
        return view('comments.admin.index', [
            'comments' => $this->commentRepository->getAllCommentsForAdmin(10, $query->validated())
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
     * @param \App\Http\Requests\Post\CreateCommentRequest $request
     * @param string $slug
     */
    public function store(CreateCommentRequest $request, string $slug): RedirectResponse
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
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id): View
    {
        return view('comments.admin.edit', [
            'comment' => $this->commentRepository->getComment($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param \App\Http\Requests\Post\UpdateCommentRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCommentRequest $request, string $id): RedirectResponse
    {
        $this->commentRepository->updateComment($request->validated(), $id);
        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->commentRepository->delete($id);
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
