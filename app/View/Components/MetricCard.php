<?php

namespace App\View\Components;

use App\Contracts\Repositories\AnalyticRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MetricCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected AnalyticRepositoryInterface $analyticRepository, public string $class = '')
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.metric-card', [
            'metrics' => $this->analyticRepository->getMajorMetrics()
        ]);
    }
}
