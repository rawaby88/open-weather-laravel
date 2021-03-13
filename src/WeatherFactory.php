<?php

namespace Rawaby88\OpenWeatherMap;

use GuzzleHttp\Exception\ClientException;
use Rawaby88\OpenWeatherMap\Clients\WeatherClient;
use Rawaby88\OpenWeatherMap\Exception\NotFoundException;

/**
 * Class WeatherFactory.
 */
abstract class WeatherFactory
{
    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     * Description language
     */
    private $language;

    /**
     * @var \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     * Unit type standard | metric | imperial
     */
    private $unitType;

    /**
     * @var mixed|WeatherClient
     */
    private $client;

    /**
     * @var string Temperature unit Kelvin | Celsius | Fahrenheit.
     */
    public $tempUnit;

    /**
     * @var string Distance unit meter/sec | miles/hour.
     */
    public $distUnit;

    /**
     * @var string Precipitation and snow Volume unit mm.
     */
    public $volUnit = 'mm';

    /**
     * @var string Pressure unit hPa.
     */
    public $presUnit = 'hPa';

    /**
     * WeatherFactory constructor.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct()
    {
        $apiKey = config('open-weather.api_token');

        if (! is_string($apiKey) || empty($apiKey)) {
            throw new \InvalidArgumentException('You must provide valid API key.');
        }

        $this->client = app()->make(WeatherClient::class);

        $this->unitType = config('open-weather.unit');
        $this->language = config('open-weather.language');

        $this->setUnitsFormat();
    }

    /**
     * Set the correct values for distance unit and temperature unit.
     */
    public function setUnitsFormat(): void
    {
        switch ($this->unitType) {
            case 'metric':
                $this->tempUnit = 'Celsius';
                $this->distUnit = 'meter/sec';
                break;
            case 'imperial':
                $this->tempUnit = 'Fahrenheit';
                $this->distUnit = 'miles/hour';
                break;
            default:
                $this->tempUnit = 'Kelvin';
                $this->distUnit = 'meter/sec';
        }
    }

    /**
     * @param \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed $unitType
     */
    public function setUnitType($unitType): void
    {
        $this->unitType = $unitType;
    }

    /**
     * @param \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed $language
     */
    public function setLanguage($language): void
    {
        $this->language = $language;
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getUnitType()
    {
        return $this->unitType;
    }

    /**
     * @param $apiCall
     * @param array $queryData
     * @throws NotFoundException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Exception
     */
    protected function queryOrFail($apiCall, array $queryData = []): object
    {
        $query = [
            'query' => [
                'lang'  => $this->language,
                'units' => $this->unitType,
                'appid' => config('open-weather.api_token'),
            ],
        ];

        foreach ($queryData as $key => $value) {
            $query['query'][$key] = $value;
        }
        try {
            $response = $this->client->get($apiCall, $query);

            return json_decode((string) $response->getBody());
        } catch (ClientException $exception) {
            $responseBodyAsString = json_decode(
                $exception->getResponse()
                          ->getBody()
                          ->getContents()
            );
            if ($responseBodyAsString->cod == 404 || $responseBodyAsString->cod == 400) {
                throw new NotFoundException($responseBodyAsString->message.' '.$exception->getMessage());
            } else {
                throw new \Exception($exception->getMessage());
            }
        }
    }
}
