<?php

namespace App\Http\Controllers\Page;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected AdRepositoryInterface $adRepository)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('pages.home.index', [
            'ads' => $this->adRepository->getLatestAds(9, 'active'),
            'upcomingAds' => $this->adRepository->getLatestAds(9, 'upcoming'),
        ]);
    }
}
