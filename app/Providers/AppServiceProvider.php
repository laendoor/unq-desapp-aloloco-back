<?php

namespace App\Providers;

use App\Model\Admin;
use App\Model\Box;
use App\Model\BoxTime;
use App\Model\Client;
use App\Model\Market;
use App\Model\Threshold;
use App\Model\User;
use App\Model\ShoppingList;
use App\Model\Product;
use App\Model\Product\StockedProduct;
use App\Repository\AdminRepository;
use App\Repository\BoxRepository;
use App\Repository\BoxTimeRepository;
use App\Repository\ClientRepository;
use App\Repository\DoctrineAdminRepository;
use App\Repository\DoctrineBoxRepository;
use App\Repository\DoctrineBoxTimeRepository;
use App\Repository\DoctrineClientRepository;
use App\Repository\DoctrineMarketRepository;
use App\Repository\DoctrineShoppingListRepository;
use App\Repository\DoctrineThresholdRepository;
use App\Repository\MarketRepository;
use App\Repository\ShoppingListRepository;
use App\Repository\ThresholdRepository;
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
        $this->app->bind(AdminRepository::class, function ($app) {
            return new DoctrineAdminRepository(
                $app['em'],
                $app['em']->getClassMetaData(Admin::class)
            );
        });

        $this->app->bind(BoxRepository::class, function ($app) {
            return new DoctrineBoxRepository(
                $app['em'],
                $app['em']->getClassMetaData(Box::class)
            );
        });

        $this->app->bind(BoxTimeRepository::class, function ($app) {
            return new DoctrineBoxTimeRepository(
                $app['em'],
                $app['em']->getClassMetaData(BoxTime::class)
            );
        });

        $this->app->bind(ClientRepository::class, function ($app) {
            return new DoctrineClientRepository(
                $app['em'],
                $app['em']->getClassMetaData(Client::class)
            );
        });

        $this->app->bind(UserRepository::class, function ($app) {
            return new DoctrineUserRepository(
                $app['em'],
                $app['em']->getClassMetaData(User::class)
            );
        });

        $this->app->bind(ShoppingListRepository::class, function ($app) {
            return new DoctrineShoppingListRepository(
                $app['em'],
                $app['em']->getClassMetaData(ShoppingList::class)
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

        $this->app->bind(MarketRepository::class, function ($app) {
            return new DoctrineMarketRepository(
                $app['em'],
                $app['em']->getClassMetaData(Market::class)
            );
        });

        $this->app->bind(ThresholdRepository::class, function ($app) {
            return new DoctrineThresholdRepository(
                $app['em'],
                $app['em']->getClassMetaData(Threshold::class)
            );
        });
    }
}
