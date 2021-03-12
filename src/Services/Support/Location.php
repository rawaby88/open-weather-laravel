<?php


namespace Rawaby88\OpenWeatherMap\Services\Support;


/**
 * Class Location
 * @package Rawaby88\OpenWeatherMap\Services\Support
 */
class Location
{
	/**
	 * @var string The city name.
	 */
	public $city;
	
	/**
	 * @var string The countryCode code.
	 */
	public $countryCode;
	
	/**
	 * @var float|null The longitude coordinate.
	 */
	public $lon;
	
	/**
	 * @var float|null The latitude coordinate.
	 */
	public $lat;
	
	/**
	 * Location constructor.
	 * @param string $city The city name.
	 * @param string $countryCode The country code.
	 * @param float|null $lat The longitude coordinate.
	 * @param float|null $lon The latitude coordinate.
	 */
	public
	function __construct( string $city, string $countryCode, $lat = null, $lon = null )
	{
		$this->city        = $city;
		$this->countryCode = $countryCode;
		$this->lat         = $lat;
		$this->lon         = $lon;
	}
	
	/**
	 * @return array
	 */
	public
	function getCoordinates()
	: array
	{
		return ["lon" => $this->lon, "lat" => $this->lat];
	}
	
	/**
	 * Encoding to json
	 * @return false|string
	 */
	public
	function toJson()
	{
		return json_encode(
			[
				'city'        => $this->city,
				'countryCode' => $this->countryCode,
				'lon'         => $this->lon,
				'lat'         => $this->lat,
			]
		);
	}
}