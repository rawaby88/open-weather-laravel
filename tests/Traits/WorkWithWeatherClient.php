<?php

namespace Rawaby88\OpenWeatherMap\Test\Traits;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Rawaby88\OpenWeatherMap\Clients\WeatherClient;

trait WorkWithWeatherClient
{
    private $mockHandler;

    protected function getPackageProviders($app)
    {
        return ['Rawaby88\OpenWeatherMap\Providers\OpenWeatherServiceProvider'];
    }

    protected function getPackageAliases($app)
    {
        return [
            'CurrentWeather' => 'Rawaby88\OpenWeatherMap\Facades\CurrentWeather',
        ];
    }

    private function swapWeatherClient(): MockHandler
    {
        $mockHandler = new MockHandler();

        $client = new WeatherClient(
            [
                'handler' => HandlerStack::create($mockHandler),
            ]
        );

        $this->app->instance(WeatherClient::class, $client);

        return $mockHandler;
    }
}
