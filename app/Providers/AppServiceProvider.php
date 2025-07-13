<?php

namespace App\Providers;

use App\Domain\Article\Contracts\ArticleRepositoryInterface;
use App\Domain\Article\Contracts\ArticleServiceInterface;
use App\Domain\Article\Repository\ArticleRepository;
use App\Domain\Article\Services\ArticleService;
use App\Domain\Category\Contracts\CategoryRepositoryInterface;
use App\Domain\Category\Contracts\CategoryServiceInterface;
use App\Domain\Category\Repository\CategoryRepository;
use App\Domain\Category\Services\CategoryService;
use App\Domain\Comment\Contracts\CommentRepositoryInterface;
use App\Domain\Comment\Contracts\CommentServiceInterface;
use App\Domain\Comment\Repository\CommentRepository;
use App\Domain\Comment\Services\CommentService;
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
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
