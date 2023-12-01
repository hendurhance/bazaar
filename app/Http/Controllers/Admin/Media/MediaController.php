<?php

namespace App\Http\Controllers\Admin\Media;

use App\Contracts\Repositories\MediaRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\FilterAdminMediaRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected MediaRepositoryInterface $mediaRepository)
    {
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \Illuminate\Http\Request $query
     * @return \Illuminate\View\View
     */
    public function index(FilterAdminMediaRequest $query): View
    {
        return view('media.admin.index', [
            'media' => $this->mediaRepository->getAllMediaForAdmin(12,$query->validated()),
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
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        return view('media.admin.show', [
            'media' => $this->mediaRepository->getMediaForAdmin($id),
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
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->mediaRepository->deleteMedia($id);
        return redirect()->route('admin.media.index')->with('success', 'Media deleted successfully.');
    }
}
