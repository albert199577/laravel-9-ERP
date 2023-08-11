<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Type;
use App\Observers\BrandObserver;
use App\Observers\TypeObserver;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.form', 'form');

        Brand::observe(BrandObserver::class);
        Type::observe(TypeObserver::class);
    }
}
