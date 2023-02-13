<?php

namespace App\Providers;

use App\Interfaces\CurrencyRateServiceInterface;
use App\Services\NbpCurrencyRateService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CurrencyRateServiceInterface::class, function () {
            return new NbpCurrencyRateService();
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
