<?php

namespace App\Providers;

use App\Model\ShoppingList;
use App\Model\Product\Product;
use App\Api\Controllers\StockController;
use App\Repository\WishListRepository;
use App\Repository\DoctrineWishListRepository;
use Illuminate\Support\ServiceProvider;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Doctrine\Common\Persistence\ObjectRepository;

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
        $this->repositoryInjection(StockController::class, Product::class);

        $this->app->bind(WishListRepository::class, function ($app) {
            // This is what Doctrine's EntityRepository needs in its constructor.
            return new DoctrineWishListRepository(
                $app['em'],
                $app['em']->getClassMetaData(ShoppingList::class)
            );
        });
    }

    /**
     * @param string $receiver
     * @param string $repo
     */
    protected function repositoryInjection(string $receiver, string $repo): void
    {
        $this->app
            ->when($receiver)
            ->needs(ObjectRepository::class)
            ->give(function () use ($repo) {
                return EntityManager::getRepository($repo);
            });
    }
}
