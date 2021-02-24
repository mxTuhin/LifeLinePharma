<?php

namespace App\Providers;

use App\Product;
use Illuminate\Support\Facades\DB;
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
        try{
            $date=date("Y-m-d");
            view()->share('totalProducts', Product::count());
            view()->share('salesToday', DB::table('invoice')->where('date','=', $date)->sum('total'));
        }
        catch (\Exception $e){

        }


    }
}
