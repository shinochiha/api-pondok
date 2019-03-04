<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use CloudCreativity\LaravelJsonApi\LaravelJsonApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        LaravelJsonApi::defaultApi('v1');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->bind('App\JsonApi\V1\Posts\Adapter', function () {
        //     return new GenericAdapter(new \App\Models\Post());
        // });

        // $this->app->bind('App\JsonApi\V1\Blogs\Adapter', function () {
        //     return new GenericAdapter(new \App\Models\Blog());
        // });
    }
}
