<?php

namespace Rawaby88\OpenWeatherMap\Test;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase;
use Rawaby88\OpenWeatherMap\Exception\NotFoundException;
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

/**
 * Class CurrentWeatherExceptionTest.
 */
class CurrentWeatherExceptionTest extends TestCase
{
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

    /** @test */
    public function it_through_an_exception_empty_api_key()
    {
        $this->expectException(\InvalidArgumentException::class);
        Config::set('open-weather.api_token', '');
        new CWByCityName('Cairo');
    }

    /** @test */
    public function it_through_an_exception_not_found_with_wrong_city_name()
    {
        $this->expectException(NotFoundException::class);
        $cw = new CWByCityName('xxx');
        $cw->get();
    }

    /** @test */
    public function it_through_an_exception_not_found_with_empty_city_name()
    {
        $this->expectException(NotFoundException::class);
        $cw = new CWByCityName('');
        $cw->get();
    }

    /** @test */
    public function it_through_an_exception_not_found_with_wrong_country_code()
    {
        $this->expectException(NotFoundException::class);
        $cw = new CWByCityName('Cairo'.'pl');
        $cw->get();
    }

    /** @test */
    public function it_through_an_exception_not_found_with_wrong_state_code()
    {
        $this->expectException(NotFoundException::class);
        $cw = new CWByCityName('Cairo', null, 'zr');
        $cw->get();
    }
}
