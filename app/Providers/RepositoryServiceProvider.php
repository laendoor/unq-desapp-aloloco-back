<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $map = [
            'Admin',
            'Box',
            'BoxTime',
            'User',
            'ShoppingList',
            'Product',
            'WishedProduct',
            'ProductCategory',
            'Market',
            'Threshold',
        ];

        collect($map)->each(function ($elem) {
            $this->app->bind('App\\Repository\\'.$elem.'Repository', function ($app) use ($elem) {
                $concrete = 'App\\Repository\\Doctrine'.$elem.'Repository';
                return new $concrete(
                    $app['em'],
                    $app['em']->getClassMetaData('App\\Model\\'.$elem)
                );
            });
        });
    }
}
