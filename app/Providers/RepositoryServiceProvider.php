<?php

namespace App\Providers;

use App\Contracts\Repositories\AdminAdRepositoryInterface;
use App\Contracts\Repositories\AdminBidRepositoryInterface;
use App\Contracts\Repositories\AdminPaymentRepositoryInterface;
use App\Contracts\Repositories\AdminPayoutMethodRepositoryInterface;
use App\Contracts\Repositories\AdminPayoutRepositoryInterface;
use App\Contracts\Repositories\AdRepositoryInterface;
use App\Contracts\Repositories\AnalyticRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\BidRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Contracts\Repositories\MediaRepositoryInterface;
use App\Contracts\Repositories\MetricRepositoryInterface;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Contracts\Repositories\PayoutMethodRepositoryInterface;
use App\Contracts\Repositories\PayoutRepositoryInterface;
use App\Contracts\Repositories\PostRepositoryInterface;
use App\Contracts\Repositories\SupportRepositoryInterface;
use App\Contracts\Repositories\TagRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Repositories\Ad\Admin\AdminAdRepository;
use App\Repositories\Auth\AuthenticateRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Ad\User\AdRepository;
use App\Repositories\Analytic\AnalyticRepository;
use App\Repositories\Bid\Admin\AdminBidRepository;
use App\Repositories\Bid\User\BidRepository;
use App\Repositories\Media\MediaRepository;
use App\Repositories\Metric\MetricRepository;
use App\Repositories\Payment\Admin\AdminPaymentRepository;
use App\Repositories\Payment\User\PaymentRepository;
use App\Repositories\Payout\Admin\AdminPayoutMethodRepository;
use App\Repositories\Payout\Admin\AdminPayoutRepository;
use App\Repositories\Payout\User\PayoutMethodRepository;
use App\Repositories\Payout\User\PayoutRepository;
use App\Repositories\Post\CommentRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Post\TagRepository;
use App\Repositories\Support\SupportRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            AuthenticateRepositoryInterface::class,
            AuthenticateRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );

        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );

        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );

        $this->app->bind(
            MediaRepositoryInterface::class,
            MediaRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            SupportRepositoryInterface::class,
            SupportRepository::class
        );

        $this->app->bind(
            MetricRepositoryInterface::class,
            MetricRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            AdRepositoryInterface::class,
            AdRepository::class
        );

        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class
        );

        $this->app->bind(
            BidRepositoryInterface::class,
            BidRepository::class
        );

        $this->app->bind(
            PayoutRepositoryInterface::class,
            PayoutRepository::class
        );

        $this->app->bind(
            PayoutMethodRepositoryInterface::class,
            PayoutMethodRepository::class
        );

        $this->app->bind(
            AnalyticRepositoryInterface::class,
            AnalyticRepository::class
        );

        $this->app->bind(
            AdminAdRepositoryInterface::class,
            AdminAdRepository::class
        );

        $this->app->bind(
            AdminBidRepositoryInterface::class,
            AdminBidRepository::class
        );

        $this->app->bind(
            AdminPayoutMethodRepositoryInterface::class,
            AdminPayoutMethodRepository::class
        );

        $this->app->bind(
            AdminPaymentRepositoryInterface::class,
            AdminPaymentRepository::class
        );

        $this->app->bind(
            AdminPayoutRepositoryInterface::class,
            AdminPayoutRepository::class
        );
    }
}
