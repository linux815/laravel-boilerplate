<?php

namespace App\Providers;

use App\Contracts\ArticleRepositoryInterface;
use App\Contracts\ArticleServiceInterface;
use App\Repository\ArticleRepository;
use App\Services\ArticleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(ArticleServiceInterface::class, ArticleService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
