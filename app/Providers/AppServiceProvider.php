<?php

namespace App\Providers;

use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CarRepositoryInterface;
use App\Repositories\BrandRepository;
use App\Repositories\CarRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
