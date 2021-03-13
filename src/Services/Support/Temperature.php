<?php

namespace Rawaby88\OpenWeatherMap\Services\Support;

/**
 * Class Temperature.
 */
class Temperature
{
    /**
     * @var int the temperature.
     */
    public $temp;

    /**
     * @var int the temperature feel likes.
     */
    public $feelsLike;

    /**
     * @var int the maximum temperature.
     */
    public $tempMax;

    /**
     * @var int the minimum temperature.
     */
    public $tempMin;

    /**
     * @var int Weather pressure.
     */
    public $pressure;

    /**
     * @var int Weather humidity.
     */
    public $humidity;

    /**
     * Temperature constructor.
     * @param float $temp the temperature
     * @param float $feelsLike the temperature feel likes.
     * @param float $tempMin the maximum temperature.
     * @param float $tempMax the minimum temperature.
     * @param int $pressure Weather pressure.
     * @param int $humidity Weather humidity.
     */
    public function __construct(float $temp, float $feelsLike, float $tempMin, float $tempMax, int $pressure, int $humidity)
    {
        $this->temp = round($temp);
        $this->feelsLike = round($feelsLike);
        $this->tempMax = round($tempMax);
        $this->tempMin = round($tempMin);
        $this->pressure = $pressure;
        $this->humidity = $humidity;
    }

    /**
     * Encoding to json.
     * @return false|string
     */
    public function toJson()
    {
        return json_encode(
            [
                'temp'      => $this->temp,
                'feelsLike' => $this->feelsLike,
                'tempMax'   => $this->tempMax,
                'tempMin'   => $this->tempMin,
                'pressure'  => $this->pressure,
                'humidity'  => $this->humidity,
            ]
        );
    }
}
