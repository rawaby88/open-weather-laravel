<?php

namespace Rawaby88\OpenWeatherMap\Services\Support;

/**
 * Class Weather
 * @package Rawaby88\OpenWeatherMap\Services\Support
 */
class Weather
{
	/**
	 * @var string[] Directions.
	 */
	private $directions = array(
		'N',
		'NNE',
		'NE',
		'ENE',
		'E',
		'ESE',
		'SE',
		'SSE',
		'S',
		'SSW',
		'SW',
		'WSW',
		'W',
		'WNW',
		'NW',
		'NNW',
		'N'
	);
	
	/**
	 * @var string Weather condition title.
	 */
	public $condition;
	
	/**
	 * @var string Weather condition description.
	 */
	public $description;
	
	/**
	 * @var string Weather icon.
	 */
	public $icon;
	
	/**
	 * @var string Icon url.
	 */
	public $iconUrl;
	
	/**
	 * @var float Wind speed percentage.
	 */
	public $windSpeed;
	
	/**
	 * @var float Wind degree.
	 */
	public $windDeg;
	
	/**
	 * @var string Wind direction.
	 */
	public $windDir;
	
	/**
	 * @var int clouds.
	 */
	public $clouds;
	
	/**
	 * @var array Precipitation volume.
	 */
	public $precipitationVolume;
	
	/**
	 * @var array Snow volume.
	 */
	public $snowVolume;
	
	/**
	 * Weather constructor.
	 * @param string $condition Weather condition title.
	 * @param string $description Weather condition description.
	 * @param string $icon Weather icon.
	 * @param float $windSpeed Wind speed percentage.
	 * @param float $windDeg Wind degree.
	 * @param int $clouds clouds.
	 * @param array $precipitationVolume Precipitation volume.
	 * @param array $snowVolume Snow volume.
	 */
	public
	function __construct( string $condition, string $description, string $icon, float $windSpeed, float $windDeg, int $clouds, array $precipitationVolume, array $snowVolume )
	{
		$this->condition           = $condition;
		$this->description         = $description;
		$this->icon                = $icon;
		$this->iconUrl             = $this->getIconUrl();
		$this->windSpeed           = $windSpeed;
		$this->windDeg             = $windDeg;
		$this->windDir             = $this->windDegToWindDirection();
		$this->clouds              = $clouds;
		$this->precipitationVolume = $precipitationVolume;
		$this->snowVolume          = $snowVolume;
	}
	
	/**
	 * Generate icon url.
	 * @return string
	 */
	public
	function getIconUrl()
	: string
	{
		return sprintf( config( 'open-weather.api_icon_url' ), $this->icon );
	}
	
	/**
	 * Convert wind degrees to wind direction.
	 * @return string
	 */
	private
	function windDegToWindDirection()
	: string
	{
		return $this->directions[ round( $this->windDeg / 22.5 ) ];
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
				'condition'           => $this->condition,
				'description'         => $this->description,
				'icon'                => $this->icon,
				'iconUrl'             => $this->iconUrl,
				'windSpeed'           => $this->windSpeed,
				'windDeg'             => $this->windDeg,
				'windDir'             => $this->windDir,
				'clouds'              => $this->clouds,
				'precipitationVolume' => $this->precipitationVolume,
				'snowVolume'          => $this->snowVolume,
			]
		);
	}
}