<?php

namespace App\Providers;
use App\Country;
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
        //
          view()->composer('*', function ($view) {
            $country_list = Country::orderBy('sort', 'asc')
                             -> orderBy('id', 'asc')
                             -> pluck('country', 'id', 'iso');
            $country_gdp = Country::orderBy('sort', 'asc')
                             -> orderBy('id', 'asc') 
                             -> pluck('gdp_weight', 'id');
            $view->with(['country_list' =>  $country_list, 'country_gdp' => $country_gdp]);
        });
    }
}
