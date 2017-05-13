<?php

namespace App\Providers;

use App\Model\Product\Product;
use App\Api\Controllers\StockController;
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
        $this->app
            ->when(StockController::class)
            ->needs(ObjectRepository::class)
            ->give(function() {
                return EntityManager::getRepository(Product::class);
            });
    }
}
