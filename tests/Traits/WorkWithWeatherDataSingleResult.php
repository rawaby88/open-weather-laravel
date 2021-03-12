<?php


namespace Rawaby88\OpenWeatherMap\Test\Traits;


use DateTime;
use GuzzleHttp\Psr7\Response;
use Rawaby88\OpenWeatherMap\Services\Support\Location;
use Rawaby88\OpenWeatherMap\Services\Support\Sun;
use Rawaby88\OpenWeatherMap\Services\Support\Temperature;
use Rawaby88\OpenWeatherMap\Services\Support\Weather;

trait WorkWithWeatherDataSingleResult
{
	
	public
	function mockSingleWeatherResponse()
	: Response
	{
		return new Response(
			200, [], json_encode(
				   [
					   "coord"      => [
						   "lon" => 21.0118,
						   "lat" => 52.2298
					   ],
					   "weather"    => [
						   [
							   "id"          => 701,
							   "main"        => "Mist",
							   "description" => "mist",
							   "icon"        => "50d"
						   ],
						   [
							   "id"          => 601,
							   "main"        => "Snow",
							   "description" => "snow",
							   "icon"        => "13d"
						   ]
					   ],
					   "base"       => "stations",
					   "main"       => [
						   "temp"       => 0.16,
						   "feels_like" => -6.77,
						   "temp_min"   => -0.56,
						   "temp_max"   => 1.11,
						   "pressure"   => 1006,
						   "humidity"   => 86
					   ],
					   "visibility" => 2500,
					   "wind"       => [
						   "speed" => 6.69,
						   "deg"   => 170
					   ],
					   "snow"       => [
						   "1h" => 1
					   ],
					   "rain"       => [
						   "3h" => 1
					   ],
					   "clouds"     => [
						   "all" => 75
					   ],
					   "dt"         => 1615480142,
					   "sys"        => [
						   "type"    => 1,
						   "id"      => 1713,
						   "country" => "PL",
						   "sunrise" => 1615438772,
						   "sunset"  => 1615480356
					   ],
					   "timezone"   => 3600,
					   "id"         => 756135,
					   "name"       => "Warsaw",
					   "cod"        => 200
				
				   ]
			   )
		);
	}
	
	
	/** @test */
	public
	function it_return_location_sun_weather_and_temperature_objects()
	{
		$this->initCall();
		
		$this->assertInstanceOf( Location::class, $this->getCurrentWeather->location );
		$this->assertInstanceOf( Sun::class, $this->getCurrentWeather->sun );
		$this->assertInstanceOf( Weather::class, $this->getCurrentWeather->weather );
		$this->assertInstanceOf( Temperature::class, $this->getCurrentWeather->temperature );
	}
	
	/** @test */
	public
	function it_return_location_coordinates()
	{
		$this->initCall();
		$location = $this->getCurrentWeather->location;
		$this->assertEquals(
			[
				"lon" => 21.0118,
				"lat" => 52.2298
			], $location->getCoordinates()
		);
		$this->assertEquals( 21.0118, $location->lon );
		$this->assertEquals( 52.2298, $location->lat );
	}
	
	/** @test */
	public
	function it_return_location_country_code()
	{
		$this->initCall();
		$this->assertEquals( 'PL', $this->getCurrentWeather->location->countryCode );
	}
	
	/** @test */
	public
	function it_return_location_json()
	{
		$this->initCall();
		$json = json_encode(
			[
				'city'        => "Warsaw",
				'countryCode' => "PL",
				'lon'         => 21.0118,
				'lat'         => 52.2298,
			]
		);
		$this->assertEquals( $json, $this->getCurrentWeather->location->toJson() );
	}
	
	/** @test */
	public
	function it_return_sun_sunset_date_time()
	{
		$this->initCall();
		$sun = $this->getCurrentWeather->sun;
		$this->assertInstanceOf( DateTime::class, $sun->sunset );
		$this->assertEquals( DateTime::createFromFormat( 'U', 1615480356 + 3600 ), $sun->sunset );
	}
	
	/** @test */
	public
	function it_return_sun_sunrise_date_time()
	{
		$this->initCall();
		$sun = $this->getCurrentWeather->sun;
		$this->assertInstanceOf( DateTime::class, $sun->sunrise );
		$this->assertEquals( DateTime::createFromFormat( 'U', 1615438772 + 3600 ), $sun->sunrise );
	}
	
	/** @test */
	public
	function it_return_sun_json()
	{
		$this->initCall();
		
		$json = json_encode(
			[
				'sunrise'  => DateTime::createFromFormat( 'U', 1615438772 + 3600 ),
				'sunset'   => DateTime::createFromFormat( 'U', 1615480356 + 3600 ),
				'timezone' => 3600
			]
		);
		$this->assertEquals( $json, $this->getCurrentWeather->sun->toJson() );
	}
	
	/** @test */
	public
	function it_return_temperature_rounded_values()
	{
		$this->initCall();
		$temperature = $this->getCurrentWeather->temperature;
		
		$this->assertEquals( round( 0.16 ), $temperature->temp );
		$this->assertEquals( round( -6.77 ), $temperature->feelsLike );
		$this->assertEquals( round( -0.56 ), $temperature->tempMin );
		$this->assertEquals( round( 1.11 ), $temperature->tempMax );
		$this->assertEquals( 1006, $temperature->pressure );
		$this->assertEquals( 86, $temperature->humidity );
	}
	
	/** @test */
	public
	function it_return_temperature_json()
	{
		$this->initCall();
		
		$json = json_encode(
			[
				'temp'      => round( 0.16 ),
				'feelsLike' => round( -6.77 ),
				'tempMax'   => round( 1.11 ),
				'tempMin'   => round( -0.56 ),
				'pressure'  => 1006,
				'humidity'  => 86,
			]
		);
		$this->assertEquals( $json, $this->getCurrentWeather->temperature->toJson() );
	}
	
	/** @test */
	public
	function it_return_weather_icon()
	{
		$this->initCall();
		$weather = $this->getCurrentWeather->weather;
		$this->assertEquals( "50d", $weather->icon );
		$this->assertEquals( '//openweathermap.org/img/w/50d.png', $weather->iconUrl );
	}
	
	/** @test */
	public
	function it_return_weather_wind()
	{
		$this->initCall();
		$weather = $this->getCurrentWeather->weather;
		$this->assertEquals( 6.69, $weather->windSpeed );
		$this->assertEquals( 170, $weather->windDeg );
		$this->assertEquals( "S", $weather->windDir );
	}
	
	/** @test */
	public
	function it_return_weather_condition_description()
	{
		$this->initCall();
		$weather = $this->getCurrentWeather->weather;
		$this->assertEquals( "Mist", $weather->condition );
		$this->assertEquals( "mist", $weather->description );
	}
	
	
	/** @test */
	public
	function it_return_weather_clouds()
	{
		$this->initCall();
		$weather = $this->getCurrentWeather->weather;
		$this->assertEquals( 75, $weather->clouds );
	}
	
	/** @test */
	public
	function it_return_weather_precipitation_and_snow_volume()
	{
		$this->initCall();
		$weather = $this->getCurrentWeather->weather;
		$this->assertEquals( [ "3h" => 1 ], $weather->precipitationVolume );
		$this->assertEquals( [ "1h" => 1 ], $weather->snowVolume );
	}
	
	/** @test */
	public
	function it_return_weather_json()
	{
		$this->initCall();
		
		$json = json_encode(
			[
				'condition'           => 'Mist',
				'description'         => 'mist',
				'icon'                => '50d',
				'iconUrl'             => '//openweathermap.org/img/w/50d.png',
				'windSpeed'           => 6.69,
				'windDeg'             => 170,
				'windDir'             => 'S',
				'clouds'              => 75,
				'precipitationVolume' => [ "3h" => 1 ],
				'snowVolume'          => [ "1h" => 1 ]
			]
		);
		$this->assertEquals( $json, $this->getCurrentWeather->weather->toJson() );
	}
	
	/** @test */
	public
	function it_return_units()
	{
		$this->initCall();
		
		$this->assertEquals( "mm", $this->cw->volUnit );
		$this->assertEquals( "hPa", $this->cw->presUnit );
		$this->assertEquals( "meter/sec", $this->cw->distUnit );
		$this->assertEquals( "Celsius", $this->cw->tempUnit );
	}
}