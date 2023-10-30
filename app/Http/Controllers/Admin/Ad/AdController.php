<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Contracts\Repositories\AdminAdRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminAdRepositoryInterface $adminAdRepository)
    {
    }

    public function index()
    {
        return view('ads.admin.index', [
            'ads' => $this->adminAdRepository->getAds(10, 'all')
        ]);
    }
}
