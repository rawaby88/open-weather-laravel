<?php

namespace Rawaby88\OpenWeatherMap\Interfaces;

use Rawaby88\OpenWeatherMap\Services\Support\CurrentWeather;

/**
 * Interface CWMultiResultInterface
 * @package Rawaby88\OpenWeatherMap\Interfaces
 */
interface CWMultiResultInterface
{
	/**
	 * Return this
	 */
	public
	function get();
	
	/**
	 * Return the $index item on the list as CurrentWeather object
	 * @param $index
	 * @return CurrentWeather
	 */
	public
	function index( $index )
	: CurrentWeather;
	
	/**
	 * Return the first item on the list as CurrentWeather object
	 * @return CurrentWeather
	 */
	public
	function first()
	: CurrentWeather;
	
	/**
	 * Return count number of the result
	 * @return int
	 */
	public
	function count()
	: int;
	
}