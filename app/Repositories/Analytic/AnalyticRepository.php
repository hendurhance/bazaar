<?php

namespace App\Repositories\Analytic;

use App\Contracts\Repositories\AnalyticRepositoryInterface;
use App\Enums\PaymentStatus;
use App\Models\Ad;
use App\Models\Bid;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class AnalyticRepository implements AnalyticRepositoryInterface
{
    /**
     * Get major metrics
     * 
     * @return array
     */
    public function getMajorMetrics(): array
    {
        $totalUsers = User::count();
        $totalAds = Ad::count();
        $totalBids = Bid::count();
        $totalAmountPaid = Bid::query()->whereHas('payment', function ($query) {
            $query->where('status', PaymentStatus::SUCCESS);
        })->sum('amount');
        
        return Cache::remember('major-metrics', 60 * 60 * 24, function () use ($totalUsers, $totalAds, $totalBids, $totalAmountPaid) {
            return [
                'total_users' => $totalUsers,
                'total_ads' => $totalAds,
                'total_bids' => $totalBids,
                'total_amount_paid' => $totalAmountPaid,
            ];
        });
    }
}
