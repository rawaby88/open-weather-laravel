<?php

namespace Rawaby88\OpenWeatherMap\Traits;

use Rawaby88\OpenWeatherMap\Services\Support\CurrentWeather;

/**
 * Trait CWMultiResultTrait
 * @package Rawaby88\OpenWeatherMap\Traits
 */
trait CWMultiResultTrait
{
	/**
	 * @var array Of CurrentWeather objects.
	 */
	private $list;
	
	/**
	 * @var array Hold query parameters for api call.
	 */
	protected $params;
	
	/**
	 * @var string Part of the api link.
	 */
	protected $apiCall;
	
	
	
	/**
	 * Return instance of CWMultiResultInterface
	 */
	public
	function get()
	{
		$data       = $this->queryOrFail( $this->apiCall, $this->params );
		$this->list = [];
		
		collect($data->list)->map(function ($result, $key){
			$this->list[ $key ] = new CurrentWeather( $result );
		});
		
		return $this;
	}
	
	/**
	 * Return the $index item on the list as CurrentWeather object.
	 * @param $index
	 * @return CurrentWeather
	 */
	public
	function index( $index )
	: CurrentWeather
	{
		return $this->list[ $index ];
	}
	
	/**
	 * Return the first item on the list as CurrentWeather object.
	 * @return CurrentWeather
	 */
	public
	function first()
	: CurrentWeather
	{
		return reset( $this->list );
	}
	
	/**
	 * Return count number of the result.
	 * @return int
	 */
	public
	function count()
	: int
	{
		return count( $this->list );
	}
}