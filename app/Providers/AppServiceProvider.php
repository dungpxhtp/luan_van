<?php

namespace App\Providers;

use App\library\Cart;
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
        /*
        view()->composer('*',function($view)
        {
            $view->with(
                [

                    'cart'=>new Cart(),
                ]
                );

        });
        */
    }
}
