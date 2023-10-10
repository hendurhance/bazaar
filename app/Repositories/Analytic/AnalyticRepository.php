<?php

namespace App\Repositories\Analytic;

use App\Contracts\Repositories\AnalyticRepositoryInterface;
use App\Enums\AdStatus;
use App\Enums\PaymentStatus;
use App\Models\Ad;
use App\Models\Bid;
use App\Models\Payment;
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

    /**
     * Get user dashboard metrics
     * 
     * @param \App\Models\User $user
     * @return array
     */
    public function getUserDashboardMetrics(User $user): array
    {
        $totalAds = $user->ads()->count();
        $totalPublishedAds = $user->ads()->where('status', AdStatus::PUBLISHED)->count();
        $totalBids = $user->bids()->count();
        $totalAcceptedBids = $user->bids()->where('is_accepted', true)->count();
        $totalBidAmount = $user->bids()->where('is_accepted', true)->sum('amount');
        $totalAmountPaid = $user->bids()->where('is_accepted', true)->whereHas('payment', function ($query) {
            $query->where('status', PaymentStatus::SUCCESS);
        })->sum('amount');
        $totalPendingPayoutAmount = Payment::query()->where('payee_id', $user->id)->where('status', PaymentStatus::PENDING)->sum('amount');
        $totalPaidPayoutAmount = Payment::query()->where('payee_id', $user->id)->where('status', PaymentStatus::SUCCESS)->sum('amount');
        $totalBidsMadeOnAdsOwnedByUser = Bid::query()->whereHas('ad', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        $totalPayoutMethods = $user->payoutMethods()->count();
        return Cache::remember('user-dashboard-metrics-' . $user->id, 60 * 60 * 24, function () use ($totalAds, $totalPublishedAds, $totalBids, $totalAcceptedBids, $totalBidAmount, $totalAmountPaid, $totalPendingPayoutAmount, $totalPaidPayoutAmount, $totalBidsMadeOnAdsOwnedByUser, $totalPayoutMethods) {
            return [
                'total_ads' => $totalAds,
                'total_published_ads' => $totalPublishedAds,
                'total_bids' => $totalBids,
                'total_accepted_bids' => $totalAcceptedBids,
                'total_bid_amount' => $totalBidAmount,
                'total_amount_paid' => $totalAmountPaid,
                'total_pending_payout_amount' => $totalPendingPayoutAmount,
                'total_paid_payout_amount' => $totalPaidPayoutAmount,
                'total_bids_made_on_ads_owned_by_user' => $totalBidsMadeOnAdsOwnedByUser,
                'total_payout_methods' => $totalPayoutMethods,
            ];
        });
    }
}
