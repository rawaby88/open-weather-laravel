<?php

namespace Rawaby88\OpenWeatherMap\Services;

use LogicException;
use Rawaby88\OpenWeatherMap\Interfaces\CWSingleResultInterface;
use Rawaby88\OpenWeatherMap\Traits\CWSingleResultTrait;
use Rawaby88\OpenWeatherMap\WeatherFactory;

/**
 * Class CWByCoordinates.
 */
class CWByCoordinates extends WeatherFactory implements CWSingleResultInterface
{
    use CWSingleResultTrait;

    /**
     * @var float The latitude coordinate
     */
    protected $lat;
    /**
     * @var float The longitude coordinate
     */
    protected $lon;

    /**
     * CWByCoordinates constructor.
     *
     * You can call by latitude and longitude coordinates.
     *
     * @param float $lat The latitude coordinate.
     * @param float $lon The longitude coordinate.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(float $lat, float $lon)
    {
        if ($lat < -90 || $lat > 90) {
            throw new LogicException('Wrong latitude given');
        }

        if ($lon < -180 || $lon > 180) {
            throw new LogicException('Wrong longitude given');
        }

        parent::__construct();
        $this->apiCall = 'weather';
        $this->lat = $lat;
        $this->lon = $lon;
        $this->params = $this->paramsToArray();
    }

    /**
     * Generate query parameters for api call.
     * @return array
     */
    private function paramsToArray(): array
    {
        return [
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
