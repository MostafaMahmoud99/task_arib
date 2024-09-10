<?php

namespace App\Providers;

use App\Mixins\ResponseMixins;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
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
        Response::mixin(new ResponseMixins());
        Schema::defaultStringLength(191);
    }
}
