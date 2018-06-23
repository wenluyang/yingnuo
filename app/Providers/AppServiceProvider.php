<?php

namespace App\Providers;

use App\Models\User;
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
        \Auth::login(User::where('open_id', 'oEulG0moXr2Gt4fIX4iXx3OuTzVY')->first());
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
        view()->composer('home.layouts.footer', 'App\Http\ViewComposers\FooterComposer');
    }
}
