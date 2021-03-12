<?php

namespace Rawaby88\OpenWeatherMap\Services;

use http\Exception\InvalidArgumentException;
use Rawaby88\OpenWeatherMap\Interfaces\CWMultiResultInterface;
use Rawaby88\OpenWeatherMap\Traits\CWMultiResultTrait;
use Rawaby88\OpenWeatherMap\WeatherFactory;

/**
 * Class CWByCitiesInCircle
 * @package Rawaby88\OpenWeatherMap\Services
 */
class CWByCitiesInCircle extends WeatherFactory implements CWMultiResultInterface
{
	use CWMultiResultTrait;
	
	/**
	 * @var float Geographical coordinates (latitude).
	 */
	protected $lat;
	/**
	 * @var float Geographical coordinates (longitude).
	 */
	protected $lon;
	/**
	 * @var int Number of cities around the point that should be returned.
	 */
	protected $cityCount;
	
	
	/**
	 * CWByCitiesInCircle constructor.
	 *
	 * returns the data from cities within the defined rectangle specified by the geographic coordinates.
	 * There is a limit of 25 square degrees for Free and Startup plans.
	 *
	 * @param float $lat Geographical coordinates (latitude).
	 * @param float $lon Geographical coordinates (longitude).
	 * @param int $cityCount Number of cities around the point that should be returned. The default number of cities is 5, the maximum is 50.
	 * @throws \Illuminate\Contracts\Container\BindingResolutionException
	 */
	public
	function __construct( float $lat, float $lon, int $cityCount = 5 )
	{
		if ( $cityCount > 50 )
		{
			throw new InvalidArgumentException( 'The maximum number of cities 50.' );
		}
		
		parent::__construct();
		$this->apiCall   = 'find';
		$this->lat       = $lat;
		$this->lon       = $lon;
		$this->cityCount = $cityCount;
		$this->params    = $this->paramsToArray();
		
	}
	
	
	/**
	 * Generate query parameters for api call.
	 * @return array
	 */
	private
	function paramsToArray()
	: array
	{
		return [
			'lat' => $this->lat,
			'lon' => $this->lon,
			'cnt' => $this->cityCount
		];
	}
}