<?php

namespace Rawaby88\OpenWeatherMap\Interfaces;

use Rawaby88\OpenWeatherMap\Services\Support\CurrentWeather;

/**
 * Interface CWSingleResultInterface.
 */
interface CWSingleResultInterface
{
    /**
     * Return APi call result as CurrentWeather object.
     * @return CurrentWeather
     */
    public function get(): CurrentWeather;
}
