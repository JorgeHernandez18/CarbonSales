<?php

namespace App\Providers;

use App\Models\DetailSale;
use App\Observers\DetailSaleObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Recordar quitar el unguard 
        //Model::unguard();
    }
}
