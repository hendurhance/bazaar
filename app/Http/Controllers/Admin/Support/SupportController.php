<?php

namespace App\Http\Controllers\Admin\Support;

use App\Contracts\Repositories\SupportRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Support\CreateSupportRequest;
use App\Http\Requests\Support\FilterAdminSupportRequest;
use App\Http\Requests\Support\UpdateSupportRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected SupportRepositoryInterface $supportRepository)
    {
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\Support\FilterAdminSupportRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminSupportRequest $query): \Illuminate\Contracts\View\View
    {
        return view('supports.admin.index', [
            'supports' => $this->supportRepository->getSupportTickets(10, 'all', $query->validated()),
        ]);
    }

    /**
     * Display a listing of the pending resource.
     * 
     * @param \App\Http\Requests\Support\FilterAdminSupportRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function pending(FilterAdminSupportRequest $query): \Illuminate\Contracts\View\View
    {
        return view('supports.admin.status.pending', [
            'pendingSupports' => $this->supportRepository->getSupportTickets(10, 'pending', $query->validated()),
        ]);
    }

    /**
     * Display a listing of the resolved resource.
     * 
     * @param \App\Http\Requests\Support\FilterAdminSupportRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function resolved(FilterAdminSupportRequest $query): \Illuminate\Contracts\View\View
    {
        return view('supports.admin.status.resolved', [
            'resolvedSupports' => $this->supportRepository->getSupportTickets(10, 'resolved', $query->validated()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supports.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \App\Http\Requests\Support\CreateSupportRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateSupportRequest $request): RedirectResponse
    {
        $this->supportRepository->createSupportTicket($request->validated());

        return request()->is('admin/*')
            ? redirect()->route('admin.support.index')->with('success', 'Your support ticket has been submitted successfully.')
            : back()->with('success', 'Your support request has been submitted successfully.');
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        return view('supports.admin.show', [
            'support' => $this->supportRepository->getSupportTicket($id),
        ]);
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
     * 
     * @param \App\Http\Requests\Support\UpdateSupportRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSupportRequest $request, string $id): RedirectResponse
    {
        $this->supportRepository->updateSupportTicket($id, $request->validated());
        return redirect()->route('admin.support.show', $id)->with('success', 'Support ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $this->supportRepository->deleteSupportTicket($id);
        return redirect()->route('admin.support.index')->with('success', 'Support ticket deleted successfully.');
    }
}
