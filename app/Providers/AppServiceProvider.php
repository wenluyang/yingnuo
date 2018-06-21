<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('admin.*', 'App\Http\ViewComposers\AdminNav');
        view()->composer('home.layouts.share', 'App\Http\ViewComposers\JssdkComposer');
    }
}
