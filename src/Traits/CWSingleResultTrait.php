<?php

namespace Rawaby88\OpenWeatherMap\Traits;

use Rawaby88\OpenWeatherMap\Services\Support\CurrentWeather;

/**
 * Trait CWSingleResultTrait
 * @package Rawaby88\OpenWeatherMap\Traits
 */
trait CWSingleResultTrait
{
	/**
	 * @var array Hold query parameters for api call.
	 */
	protected $params;
	
	/**
	 * @var string Part of the api link.
	 */
	protected $apiCall;
	
	/**
	 * Return APi call result as CurrentWeather object.
	 * @return CurrentWeather
	 */
	public
	function get()
	: CurrentWeather
	{
		return new CurrentWeather( $this->queryOrFail( $this->apiCall, $this->params ) );
	}
}