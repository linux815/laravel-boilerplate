<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\Dashboard;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        $permissions = ItemPermission::group('Article')
            ->addPermission('create-article', 'Create Article')
            ->addPermission('update-article', 'Update Article')
            ->addPermission('delete-article', 'Delete Article');
        $dashboard->registerPermissions($permissions);

        $permissions = ItemPermission::group('Category')
            ->addPermission('create-category', 'Create Category')
            ->addPermission('update-category', 'Update Category')
            ->addPermission('delete-category', 'Delete Category');
        $dashboard->registerPermissions($permissions);

        $permissions = ItemPermission::group('Comment')
            ->addPermission('update-comment', 'Update Comment')
            ->addPermission('delete-comment', 'Delete Comment');
        $dashboard->registerPermissions($permissions);
    }
}
