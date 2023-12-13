<?php

namespace App\Repositories\Metric;

use App\Contracts\Repositories\MetricRepositoryInterface;
use App\Enums\PaymentStatus;
use App\Models\Ad;
use App\Models\Bid;
use App\Models\Media;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class MetricRepository implements MetricRepositoryInterface
{
    /**
     * Get metrics for admin
     * 
     * @return array<mixed>
     */
    public function getMetricsForAdmin(): array
    {
        return [
            'total_users' => $this->getTotalAndIncreasePercentage(User::class),
            'total_ads' => $this->getTotalAndIncreasePercentage(Ad::class),
            'total_bids' =>  $this->getTotalAndIncreasePercentage(Bid::class),
            'total_transactions' => $this->getTotalAndTransactionsIncreasePercentage(),
            'yearly_analytics' => $this->getYearlyAnalytics(),
            'payment_analytics' => $this->getPaymentAnalytics(),
            'location_analytics' => $this->getLocationAnalytics(),
        ];
    }

    /**
     * Search for a query
     * 
     * @param string $query
     */
    public function search(string $query, int $perPage = 25): array
    {
        $start = microtime(true);

        $combinedResults = collect();

        // User search
        $userSearch = User::select('id', 'name', 'email', 'avatar', 'username', 'created_at')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->orWhere('id', $query)
            ->orderBy('id', 'desc')
            ->get();

        // Media search
        $mediaSearch = Media::select('id', 'name', 'url', 'created_at')
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('id', $query)
            ->orderBy('id', 'desc')
            ->get();

        // Ad search
        $adSearch = Ad::select('id', 'slug', 'title', 'created_at', 'description', 'price', 'category_id', 'sub_category_id')
            ->with('category:id,name', 'subCategory:id,name')
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('id', $query)
            ->orderBy('id', 'desc')
            ->get();

        // Bid search
        $bidSearch = Bid::select('id', 'ad_id', 'user_id', 'amount', 'created_at')
            ->with('ad:id,title')
            ->with('user:id,name')
            ->whereBetween('amount', [0, $query])
            ->orWhere('id', $query)
            ->orderBy('id', 'desc')
            ->get();

        // Combine results into a common structure
        $combinedResults = $combinedResults->merge($userSearch)->merge($mediaSearch)->merge($adSearch)->merge($bidSearch);

        // Paginate the combined results
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $combinedResults->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedResults = new LengthAwarePaginator($currentPageItems, count($combinedResults), $perPage, $currentPage);
        $paginatedResults->withPath(route('admin.search', ['q' => $query]));

        $modelFlag = [
            'ad' => false,
            'user' => false,
            'media' => false,
            'bid' => false,
        ];

        foreach ($paginatedResults as $item) {
            match (true) {
                $item instanceof Ad => $modelFlag['ad'] = true,
                $item instanceof User => $modelFlag['user'] = true,
                $item instanceof Media => $modelFlag['media'] = true,
                $item instanceof Bid => $modelFlag['bid'] = true,
            };
        }

        return [
            'results' => $paginatedResults,
            'total' => $paginatedResults->total(),
            'seconds' => microtime(true) - $start,
            'model_flag' => $modelFlag,
        ];
    }

    /**
     * Get the total number of a model count, with the increase in percentage of the last 7 days
     * 
     * @param string $model
     * @return array<string, int>
     */
    private function getTotalAndIncreasePercentage(string $model): array
    {
        $total = $model::count();
        $lastWeekTotal = $model::whereBetween('created_at', [now()->subDays(7), now()])->count();
        $increasePercentage = $this->getIncreasePercentage($total, $lastWeekTotal);
        $chart = $this->getChartData($model, $model === Ad::class ? 15 : 7);
        return [
            'total' => $total,
            'increase_percentage' => $increasePercentage,
            'chart' => $chart,
        ];
    }

    /**
     * Get the increase percentage
     * 
     * @param int $total
     * @param int $lastWeekTotal
     * @return int
     */
    private function getIncreasePercentage(int $total, int $lastWeekTotal): int
    {
        if ($lastWeekTotal === 0) {
            return 0;
        }

        return (($total - $lastWeekTotal) / $lastWeekTotal) * 100;
    }

    /**
     * Get the total number of transactions, with the increase in percentage of the last 7 days
     * 
     * @return array<string, int>
     */
    private function getTotalAndTransactionsIncreasePercentage(): array
    {
        $total = Payment::where('status', PaymentStatus::SUCCESS)->sum('amount');
        $lastWeekTotal = Payment::where('status', PaymentStatus::SUCCESS)
            ->whereBetween('created_at', [now()->subDays(7), now()])->sum('amount');
        $increasePercentage = $this->getIncreasePercentage($total, $lastWeekTotal);
        return [
            'total' => $total,
            'increase_percentage' => $increasePercentage,
            'chart' => $this->getChartData(Payment::class, 20),
        ];
    }

    /**
     * Get the chart data
     * 
     * @param string $model
     * @param int $days = 7
     * @return array<mixed>
     */
    private function getChartData(string $model, int $days = 7): array
    {
        $lastDays = array_map(function ($i) {
            return now()->subDays($i)->format('Y-m-d');
        }, range(0, $days - 1));

        // Fetch data from the database for the last 7 days
        $chartData = $model::selectRaw($model === Payment::class ? 'DATE(created_at) as date, SUM(amount) as total' : 'DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays($days - 1)->toDateString())
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date')
            ->all();

        // Initialize arrays for labels and data, fill missing dates with 0
        return [
            'labels' => $lastDays,
            'data' => array_map(function ($date) use ($chartData) {
                return $chartData[$date] ?? 0;
            }, $lastDays),
        ];
    }

    /**
     * Get yearly analytics
     * 
     * @return array<mixed>
     */
    private function getYearlyAnalytics(): array
    {
        // we will get the data for bids against ads and group them by months
        $bids = Bid::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(11)->toDateString())
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->all();

        $ads = Ad::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(11)->toDateString())
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->all();

        // Set the labels for the chart, those with no data will be filled with 0
        $labels = array_map(function ($i) {
            return now()->subMonths(11)->addMonths($i)->format('M');
        }, range(0, 11));

        return [
            'labels' => $labels,
            'data' => [
                'bids' => array_map(function ($month) use ($bids) {
                    return $bids[$month] ?? 0;
                }, range(1, 12)),
                'ads' => array_map(function ($month) use ($ads) {
                    return $ads[$month] ?? 0;
                }, range(1, 12)),
            ],
        ];
    }

    /**
     * Get payment analytics
     * 
     * @return array<mixed>
     */
    private function getPaymentAnalytics(): array
    {
        // we will get the data for payments and group them by months
        $payments = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->where('created_at', '>=', now()->subMonths(11)->toDateString())
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('total', 'month')
            ->all();

        // Set the labels for the chart, those with no data will be filled with 0
        $labels = array_map(function ($i) {
            return now()->subMonths(11)->addMonths($i)->format('M');
        }, range(0, 11));

        return [
            'labels' => $labels,
            'data' => array_map(function ($month) use ($payments) {
                return $payments[$month] ?? 0;
            }, range(1, 12)),
        ];
    }

    /**
     * Get location analytics
     * 
     * @return array<mixed>
     */
    private function getLocationAnalytics(): array
    {
        $users = User::selectRaw('country_id, COUNT(*) as total')
            ->with('country:id,name')
            ->groupBy('country_id')
            ->orderBy('total', 'desc')
            ->get()
            ->take(10)
            ->pluck('total', 'country.name')
            ->all();

        return [
            'labels' => array_keys($users),
            'data' => array_values($users),
        ];
    }
}
