<?php

namespace Rawaby88\OpenWeatherMap\Providers;

use Illuminate\Support\ServiceProvider;
use Rawaby88\OpenWeatherMap\Clients\WeatherClient;

/**
 * Class OpenWeatherServiceProvider.
 */
class OpenWeatherServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(WeatherClient::class, function () {
            return new WeatherClient(
                [
                    'base_uri' => config('open-weather.base_uri'),
                ]
            );
        });

        $this->mergeConfigFrom(__DIR__.'/../config/open-weather.php', 'open-weather');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/../config/open-weather.php' => base_path('config/open-weather.php'),
            ], 'config'
        );
    }
}
