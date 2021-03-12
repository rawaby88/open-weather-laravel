<?php


namespace Rawaby88\OpenWeatherMap\Services\Support;

use LogicException;

/**
 * Class Sun
 * @package Rawaby88\OpenWeatherMap\Services\Support
 */
class Sun
{
	/**
	 * @var int The sunrise time.
	 */
	public $sunrise;
	
	/**
	 * @var int The sunset time.
	 */
	public $sunset;
	
	/**
	 * @var int The timezone.
	 */
	public $timezone;
	
	/**
	 * Create a new sun object.
	 *
	 * @param int $sunrise The sunrise time.
	 * @param int $sunset The sunset time.
	 * @param int $timezone
	 *
	 * @internal
	 */
	public
	function __construct( int $sunrise, int $sunset, int $timezone )
	{
		if ( $sunset < $sunrise )
		{
			throw new LogicException( 'Sunset cannot be before sunrise!' );
		}
		
		$this->timezone = $timezone;
		$this->setSunrise($sunrise);
		$this->setSunset($sunset);
	}
	
	/**
	 * Set sunrise time.
	 * @param int $sunrise
	 */
	public
	function setSunrise( int $sunrise )
	: void
	{
		$this->sunrise = \DateTime::createFromFormat('U', $sunrise + $this->timezone) ;
	}
	
	/**
	 * Set sunset time.
	 * @param int $sunset
	 */
	public
	function setSunset( int $sunset )
	: void
	{
		$this->sunset = \DateTime::createFromFormat('U', $sunset + $this->timezone) ;
	}
	
	/**
	 * Encoding to json.
	 * @return false|string
	 */
	public
	function toJson()
	{
		return json_encode(
			[
				'sunrise'  => $this->sunrise,
				'sunset'   => $this->sunset,
				'timezone' => $this->timezone
			]
		);
	}
}