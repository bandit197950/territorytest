<?php

namespace App\Providers;

use App\Services\Farm\Farm;
use App\Services\Farm\FarmManagement;
use App\Services\Production\ProductionStatistics;
use App\Services\Production\ProductionStorage;
use App\Services\Production\ProductionStorageInMemory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(ProductionStorage::class, ProductionStorageInMemory::class);
        app()->singleton(Farm::class, fn(Application $app) => new Farm($app->make(ProductionStorage::class)));
        app()->bind(FarmManagement::class, function(Application $app) {
            return new FarmManagement($app->make(Farm::class), $app->make(ProductionStatistics::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
