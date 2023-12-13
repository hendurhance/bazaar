<?php

namespace App\Http\Controllers\Admin\Search;

use App\Contracts\Repositories\MetricRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchQueryRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
     /**
     * Instantiate new controller instance
     */
    public function __construct(protected MetricRepositoryInterface $metricRepository)
    {}

    /**
     * Handle the incoming request.
     */
    public function __invoke(SearchQueryRequest $request)
    {
        return view('dashboard.admin.search', $this->metricRepository->search($request->validated()['q']));
    }
}
