<?php

namespace App\Providers;

use App\Model\Product\StockedProduct;
use App\Model\ShoppingList;
use App\Model\Product\Product;
use App\Repository\DoctrineStockedProductRepository;
use App\Repository\ProductRepository;
use App\Repository\WishListRepository;
use App\Repository\StockedProductRepository;
use App\Repository\DoctrineProductRepository;
use App\Repository\DoctrineWishListRepository;
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
        $this->app->bind(StockedProductRepository::class, function ($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineStockedProductRepository(
                $app['em'],
                $app['em']->getClassMetaData(StockedProduct::class)
            );
        });

        $this->app->bind(WishListRepository::class, function ($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineWishListRepository(
                $app['em'],
                $app['em']->getClassMetaData(ShoppingList::class)
            );
        });

        $this->app->bind(ProductRepository::class, function ($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineProductRepository(
                $app['em'],
                $app['em']->getClassMetaData(Product::class)
            );
        });
    }
}
