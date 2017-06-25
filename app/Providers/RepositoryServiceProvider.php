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
        $repos = collect([
            'Admin',
            'Box',
            'BoxTime',
            'User',
            'ShoppingList',
            'Price',
            'Product',
            'WishedProduct',
            'ProductCategory',
            'Market',
            'Offer',
            'Threshold',
        ]);

        $repos->each(function ($model) {
            $this->app->bind('App\\Repository\\'.$model.'Repository', function ($app) use ($model) {
                $repository = 'App\\Repository\\Doctrine'.$model.'Repository';
                return new $repository(
                    $app['em'],
                    $app['em']->getClassMetaData('App\\Model\\'.$model)
                );
            });
        });
    }
}
