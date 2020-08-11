<?php

namespace App\Providers;

use App\library\Cart;
use App\Models\brandproducts;
use App\Models\categoryproducts;
use App\Models\gendercategoryproducts;
use App\Models\post;
use App\Models\topic;
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

        view()->composer('*',function($view)
        {
            $brandsproducts=brandproducts::where('status','=','1')->get();
            $categoryproducts=categoryproducts::where('status','=','1')->get();
            $gendercategoryproducts=gendercategoryproducts::where('status','=','1')->get();
            $topic=topic::where('status','=','1')->get();
            $postnew=post::where([['status','=',1]])->orderBy('created_at','asc')->take(5)->get();


            $view->with(
                [
                    'brandsproducts'=> $brandsproducts,
                    'categoryproducts'=>$categoryproducts,
                    'gendercategoryproducts'=>$gendercategoryproducts,
                    'topic'=>$topic,
                    'postnew'=>$postnew,
                ]
                );

        });

    }
}
