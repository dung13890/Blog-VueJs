<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use League\Glide\ServerFactory;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\Urls\UrlBuilderFactory;

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
        if (env('APP_ENV') == 'local' || env('APP_ENV') == 'dev') {
            $this->app->register(\Lord\Laroute\LarouteServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }

        $this->app->singleton('glide', function () {
            return ServerFactory::create([
                'source' => \Storage::disk('image')->getDriver(),
                'cache' => \Storage::disk('image')->getDriver(),
                'cache_path_prefix' => 'cache',
                'base_url' => null,
                'max_image_size' => 2000 * 2000,
                'presets' => [
                    'thumbnail' => [
                        'w' => 100,
                        'h' => 100,
                        'fit' => 'crop',
                    ],
                    'small' => [
                        'w' => 320,
                        'h' => 240,
                        'fit' => 'crop',
                    ],
                    'medium' => [
                        'w' => 640,
                        'h' => 480,
                        'fit' => 'crop',
                    ],
                    'large' => [
                        'w' => 800,
                        'h' => 600,
                        'fit' => 'crop',
                    ],
                ],
                'response' => new LaravelResponseFactory(),
            ]);
        });

        $this->app->singleton('glide.builder', function () {
            return UrlBuilderFactory::create(null, env('GLIDE_SIGNKEY'));
        });

        $this->app->bind(
            \App\Contracts\Services\MediaInterface::class,
            \App\Services\MediaService::class
        );

        $this->composers();
    }

    public function composers()
    {
        view()->composer('backend.*', function ($view) {
            $view->with('me', \Auth::guard('backend')->user());
        });
    }
}
