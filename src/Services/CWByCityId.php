<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Rawaby88\OpenWeatherMap\Interfaces\CWSingleResultInterface;
use Rawaby88\OpenWeatherMap\Traits\CWSingleResultTrait;
use Rawaby88\OpenWeatherMap\WeatherFactory;

/**
 * Class CWByCityId.
 */
class CWByCityId extends WeatherFactory implements CWSingleResultInterface
{
    use CWSingleResultTrait;

    /**
     * @var int City ID. List of city ID 'city.list.json.gz'
     */
    protected $cityId;

    /**
     * CWByCityName constructor.
     *
     * You can make an API call by city ID. List of city ID 'city.list.json.gz' can be downloaded
     * here http://bulk.openweathermap.org/sample/
     *
     * @param int $cityId City ID. List of city ID 'city.list.json.gz'
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(int $cityId)
    {
        parent::__construct();
        $this->apiCall = 'weather';
        $this->cityId = $cityId;
        $this->params = $this->paramsToArray();
    }

    /**
     * Generate query parameters for api call.
     * @return array
     */
    private function paramsToArray(): array
    {
        return ['id' => $this->cityId];
    }
}
