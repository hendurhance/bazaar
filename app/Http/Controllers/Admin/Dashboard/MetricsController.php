<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Contracts\Repositories\MetricRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MetricsController extends Controller
{

    /** 
     * Instantiate a new controller instance.
     * @param MetricRepositoryInterface $repository
     */
    public function __construct(protected MetricRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Show dashboard analytics page
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('dashboard.admin.index', [
            'metrics' => $this->repository->getMetricsForAdmin(),
        ]);
    }
}
