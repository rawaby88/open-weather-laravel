<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Rawaby88\OpenWeatherMap\Interfaces\CWSingleResultInterface;
use Rawaby88\OpenWeatherMap\Traits\CWSingleResultTrait;
use Rawaby88\OpenWeatherMap\WeatherFactory;

/**
 * Class CWByZipCode.
 */
class CWByZipCode extends WeatherFactory implements CWSingleResultInterface
{
    use CWSingleResultTrait;

    /**
     * @var string Zip code.
     */
    protected $zipCode;

    /**
     * @var string ISO 3166 country codes.
     */
    protected $countryCode;

    /**
     * CWByZipCode constructor.
     *
     * You can call by zip code.
     * Please note if countryCode is not specified then the search works for USA as a default.
     *
     * @param string $zipCode Zip code.
     * @param string|null $countryCode ISO 3166 country codes.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(string $zipCode, string $countryCode = 'us')
    {
        parent::__construct();
        $this->apiCall = 'weather';
        $this->zipCode = $zipCode;
        $this->countryCode = $countryCode;
        $this->params = $this->paramsToArray();
    }

    /**
     * Generate query parameters for api call.
     * @return array
     */
    private function paramsToArray(): array
    {
        $zip = $this->zipCode;
        if ($this->countryCode) {
            $zip .= ','.$this->countryCode;
        }

        return ['zip' => $zip];
    }
}
