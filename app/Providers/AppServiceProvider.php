<?php

namespace App\Providers;

use App\Model\User;
use App\Model\ShoppingList;
use App\Model\Product\Product;
use App\Model\Product\StockedProduct;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use App\Repository\WishListRepository;
use App\Repository\StockedProductRepository;
use App\Repository\DoctrineUserRepository;
use App\Repository\DoctrineProductRepository;
use App\Repository\DoctrineWishListRepository;
use App\Repository\DoctrineStockedProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(UserRepository::class, function ($app) {
            return new DoctrineUserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->bind(WishListRepository::class, function ($app) {
            return new DoctrineWishListRepository(
                $app['em'],
                $app['em']->getClassMetaData(ShoppingList::class)
            );
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            return new DoctrineProductRepository(
                $app['em'],
                $app['em']->getClassMetaData(Product::class)
            );
        });
    }
}
