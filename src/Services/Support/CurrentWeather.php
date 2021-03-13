<?php

namespace Rawaby88\OpenWeatherMap\Services\Support;

/**
 * Class CurrentWeather.
 */
class CurrentWeather
{
    /**
     * @var Weather object
     */
    public $weather;
    /**
     * @var Location object
     */
    public $location;
    /**
     * @var Sun object
     */
    public $sun;
    /**
     * @var Temperature object
     */
    public $temperature;

    /**
     * CurrentWeather constructor.
     * Generate Weather, Location, Sun, and Temperature objects from given data.
     * @param $data
     */
    public function __construct($data)
    {
        $this->weather = $this->initWeather($data);
        $this->location = $this->initLocation($data);
        $this->sun = $this->initSun($data);
        $this->temperature = $this->initTemperature($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function initWeather($data): Weather
    {
        if (isset($this->weather)) {
            return $this->weather;
        }

        $rain = [];
        $snow = [];
        if (isset($data->rain)) {
            $rainArray = (array) $data->rain;
            $rain[array_key_first($rainArray)] = reset($rainArray);
        }

        if (isset($data->snow)) {
            $snowArray = (array) $data->snow;
            $snow[array_key_first($snowArray)] = reset($snowArray);
        }

        return new Weather(
            $data->weather[0]->main, $data->weather[0]->description, $data->weather[0]->icon, $data->wind->speed, $data->wind->deg, $data->clouds->all ?? $data->clouds->today, $rain, $snow
        );
    }

    /**
     * @param $data
     * @return Temperature
     */
    private function initTemperature($data): Temperature
    {
        return isset($this->temperature)
            ? $this->temperature
            : new Temperature($data->main->temp, $data->main->feels_like, $data->main->temp_min, $data->main->temp_max, $data->main->pressure, $data->main->humidity);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function initLocation($data): Location
    {
        if (isset($this->location)) {
            return $this->location;
        }

        $lat = 0;
        $lon = 0;
        $country = isset($data->sys)
            ? $data->sys->country
            : 'undefined';
        if (isset($data->coord)) {
            $lat = $data->coord->lat ?? $data->coord->Lat;
            $lon = $data->coord->lon ?? $data->coord->Lon;
        }

        return new Location($data->name, $country, $lat, $lon);
    }

    /**
     * @param $data
     * @return mixed
     */
    private function initSun($data): Sun
    {
        return isset($this->sun)
            ? $this->sun
            : new Sun($data->sys->sunrise ?? 0, $data->sys->sunset ?? 0, $data->timezone ?? 0);
    }
}
