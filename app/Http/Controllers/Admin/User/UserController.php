<?php

namespace App\Http\Controllers\Admin\User;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\FilterAdminUserRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
     /**
     * Instantiate new controller instance
     */
    public function __construct(protected UserRepositoryInterface $userRepository)
    {}

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminUserRequest $query): View
    {
        return view('users.admin.index', [
            'users' => $this->userRepository->getUsersForAdmin(10, $query->validated()),
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
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        return view('users.admin.show', [
            'user' => $this->userRepository->getUserForAdmin($id),
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
     */
    public function destroy(string $id)
    {
        //
    }
}
