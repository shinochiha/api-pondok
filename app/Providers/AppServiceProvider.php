<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Http\JsonApi\MediaTypeGuard;
use App\Http\JsonApi\EncoderService;

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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->configure('json-api');

        $this->mergeConfigFrom(__DIR__ . '/../Http/JsonApi/config/json-api.php', 'json-api');

        $this->app->bind(MediaTypeGuard::class, function ($app) {
            return new MediaTypeGuard(config('json-api.media-type'), config('json-api.accept-header-policy'));
        });

        $this->app->bind(EncoderService::class, function ($app) {
            return new EncoderService(config('json-api'));
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [MediaTypeGuard::class, EncoderService::class];
    }
}
