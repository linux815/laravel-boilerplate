<?php

namespace App\Providers;

use App\Domain\Article\Article;
use App\Domain\Article\ArticlePolicy;
use App\Domain\Category\Category;
use App\Domain\Category\CategoryPolicy;
use App\Domain\Comment\Comment;
use App\Domain\Comment\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Category::class => CategoryPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
