<?php

namespace App\Http\Controllers\Page;

use App\Contracts\Repositories\SupportRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Support\CreateSupportRequest;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected SupportRepositoryInterface $supportRepository)
    {
    }

    /**
     * Store a new support request
     * 
     * @param \App\Http\Requests\Support\CreateSupportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSupportRequest $request): RedirectResponse
    {
        $this->supportRepository->createSupportTicket($request->validated());

        return back()->with('success', 'Your support request has been submitted successfully.');
    }
}
