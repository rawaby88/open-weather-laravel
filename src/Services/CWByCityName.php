<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Rawaby88\OpenWeatherMap\Interfaces\CWSingleResultInterface;
use Rawaby88\OpenWeatherMap\Traits\CWSingleResultTrait;
use Rawaby88\OpenWeatherMap\WeatherFactory;

/**
 * Class CWByCityName.
 */
class CWByCityName extends WeatherFactory implements CWSingleResultInterface
{
    use CWSingleResultTrait;

    /**
     * @var string The city name.
     */
    protected $cityName;

    /**
     * @var string The state code.
     */
    protected $stateCode;

    /**
     * @var string ISO 3166 country codes.
     */
    protected $countryCode;

    /**
     * CWByCityName constructor.
     *
     * You can call by city name or city name, state code and country code.
     * Please note that searching by states available only for the USA locations.
     *
     * @param string $cityName The city name.
     * @param string|null $countryCode ISO 3166 country codes.
     * @param string|null $stateCode The state code.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(string $cityName, string $countryCode = null, string $stateCode = null)
    {
        parent::__construct();
        $this->apiCall = 'weather';
        $this->cityName = $cityName;
        $this->stateCode = $stateCode;
        $this->countryCode = $countryCode;
        $this->params = $this->paramsToArray();
    }

    /**
     * Generate query parameters for api call.
     * @return array
     */
    private function paramsToArray(): array
    {
        $q = $this->cityName;

        if ($this->stateCode) {
            $q .= ','.$this->stateCode;
        }
        if ($this->countryCode) {
            $q .= ','.$this->countryCode;
        }

        return ['q' => $q];
    }
}
