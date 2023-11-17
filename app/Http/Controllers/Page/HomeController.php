<?php

namespace App\Http\Controllers\Page;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected AdRepositoryInterface $adRepository, protected PostRepositoryInterface $postRepository)
    {
    }

    /**
     * Handle the incoming request.
     * 
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return view('pages.home.index', [
            'ads' => $this->adRepository->getLatestAds(9, 'active'),
            'upcomingAds' => $this->adRepository->getLatestAds(9, 'upcoming'),
            'posts' => $this->postRepository->getAllPosts(3)
        ]);
    }
}
