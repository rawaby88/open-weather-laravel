# Open Weather Map Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rawaby88/open-weather-laravel.svg?style=flat-square)](https://packagist.org/packages/rawaby88/open-weather-laravel)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rawaby88/open-weather-laravel/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/rawaby88/open-weather-laravel/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/rawaby88/open-weather-laravel/badges/build.png?b=main)](https://scrutinizer-ci.com/g/rawaby88/open-weather-laravel/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/rawaby88/open-weather-laravel/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE.md)

🌡 Laravel package to provide Open Weather map API integration.

#### [Star ⭐](https://github.com/rawaby88/open-weather-laravel) repo to show suport 🍺

To use this package you'll need to register into Open Weather Map service and generate an API Key. For more information
visit: https://home.openweathermap.org/api_keys

## Installation

Require this package with composer:

```bash
composer require rawaby88/open-weather-laravel
```

### Add Service Provider & Facade

#### For Laravel 5.5+

Once the package is added, the service provider and facade will be autodiscovered.

#### For Older versions of Laravel

Add the ServiceProvider to the providers array in `config/app.php`:

```
Rawaby88\OpenWeatherMap\Providers\OpenWeatherServiceProvider::class,
```

### Publish Config

Once done, publish the config to your config folder using:

```
php artisan vendor:publish --provider="Rawaby88\OpenWeatherMap\Providers\OpenWeatherServiceProvider"
```

## Configuration

Once the config file is published, open `config/open-weather.php`

#### Global config

`api_token`  
Your API key goes here. Or add it to your .env file `WEATHER_API_TOKEN`

`api_icon_url`  
Url display the icons that sent from the API / or create your own icons

`unit`  
Temperature is available in fahrenheit, celsius and kelvin units.

`language`  
Weather description language.

## Usage

### Call current weather data for one location

#### By city name
You can call by city name or city name and country code or city name, country state code . Please note that searching by
states available only for the USA locations.
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = (new CWByCityName('London'))->get();
/**
 * With ISO 3166 country codes 
 * $cw = (new CWByCityName('Warsaw', 'pl'))->get();
 */
```
#### By city id
You can make an API call by city ID. List of city ID 'city.list.json.gz' can be downloaded
* here http://bulk.openweathermap.org/sample/
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityId;

$cw = (new CWByCityId(2172797))->get();
```

#### By geographic coordinates
You can make an API call by zip code.
Please note if country is not specified then the search works for USA as a default.
```php
use Rawaby88\OpenWeatherMap\Services\CWByZipCode;

$cw = (new CWByZipCode(94040, 'us'))->get();
```

#### By ZIP code
You can call by latitude and longitude coordinates
```php
use Rawaby88\OpenWeatherMap\Services\CWByCoordinates;

// CWByCoordinates(latitude, longitude)
$cw = (new CWByCoordinates(35, 139))->get();
```


#### Example for single result
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = (new CWByCityName('London'))->get();
/**
 * With ISO 3166 country codes 
 * $cw = (new CWByCityName('Warsaw', 'pl'))->get();
 */

$temperature = $cw->temperature; // return Temperature object
$weather     = $cw->weather;     // return Weather object 
$location    = $cw->location;    // return Location object  
$sun         = $cw->sun;         // return Sun object

/** 
 * Each one of [temperature, weather, location, sun]
 * can be encoded to json by calling toJson();
 */
$temperature->toJson();
$weather->toJson();
$location->toJson();
$sun->toJson();
```

### Call current weather data for several cities

#### Cities within a rectangle zone
API returns the data from cities within the defined rectangle specified by the geographic coordinates.
```php
use Rawaby88\OpenWeatherMap\Services\CWByRectangleZone;

//CWByRectangleZone(lon-left,lat-bottom,lon-right,lat-top,zoom)
$cw = (new CWByRectangleZone(12,32,15,37,10))->get();
```

#### Cities within a rectangle zone
API returns the data from cities within the defined rectangle specified by the geographic coordinates.
```php
use Rawaby88\OpenWeatherMap\Services\CWByCitiesInCircle;

//CWByCitiesInCircle(latitude, longitude, number_of cities_to_return)
$cw = (new CWByCitiesInCircle(55.5, 37.5, 10))->get();
```

#### Example for several cities
```php
use Rawaby88\OpenWeatherMap\Services\CWByCitiesInCircle;

$cw = (new CWByCitiesInCircle(55.5, 37.5, 10))->get();

//to loop through cities result
foreach ($cw->list as $city)
{
    $temperature = $city->temperature; // return Temperature object
    $weather     = $city->weather;     // return Weather object 
    $location    = $city->location;    // return Location object  
    $sun         = $city->sun;         // return Sun object
}

//get specific city with index
$city1 = $cw->index(2);

//get cities count in the list
$city1 = $cw->count();

//get the first city in the list
$city1 = $cw->first();
```



#### Temperature Object
Contents Temperature information
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = (new CWByCityName('London'))->get();
$temperature = $cw->temperature;

$temperature->temp; //return current temperature
$temperature->feelsLike; //return feels like
$temperature->tempMax; //return max temperature
$temperature->tempMin; //return min temperature
$temperature->pressure; //return pressure
$temperature->humidity; //return humidity

/**
 * toJson()
 * {"temp":9,"feelsLike":4,"tempMax":10,"tempMin":9,"pressure":1000,"humidity":53}
 */ 
$temperature->toJson();
```

#### Weather Object
Contents Weather information
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = (new CWByCityName('London'))->get();
$weather = $cw->weather;

$weather->condition; //return current condition
$weather->description; //return weather description
$weather->icon; //return weather icon
$weather->iconUrl; //return icon url
$weather->windSpeed; //return wind speed
$weather->windDeg; //return wind degree
$weather->windDir; //return wind direction
$weather->clouds; //return clouds
$weather->precipitationVolume; //return rain volume
$weather->snowVolume; //return snow volume
                
/**
 * toJson()
 * {"condition":"Clouds","description":"broken clouds","icon":"04d","iconUrl":"\/\/openweathermap.org\/img\/w\/04d.png","windSpeed":5.14,"windDeg":210,"windDir":"SSW","clouds":75,"precipitationVolume":[],"snowVolume":[]} 
 */
$weather->toJson();
```
#### Sun Object
Contents Sun information
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = (new CWByCityName('London'))->get();
$sun = $cw->sun;

$sun->sunrise; //return sunrise
$sun->sunset; //return sunset
$sun->timezone; //return timezone

/**
 * toJson()
 * {"sunrise":{"date":"2021-03-13 05:54:53.000000","timezone_type":1,"timezone":"+00:00"},"sunset":{"date":"2021-03-13 17:36:07.000000","timezone_type":1,"timezone":"+00:00"},"timezone":3600}
 */ 
$sun->toJson();
```

#### Location Object
Contents Location information
```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = (new CWByCityName('London'))->get();
$location = $cw->location;

$location->city; //return city name
$location->countryCode; //return ISO country code
$location->lon; //return longitude coordinate
$location->lat; //return latitude coordinate

/**
 * toJson()
 * {"city":"Warsaw","countryCode":"PL","lon":21.0118,"lat":52.2298}
 */ 
$location->toJson();
```

### Parameters unit & language
Weather parameters unit

```php
use Rawaby88\OpenWeatherMap\Services\CWByCityName;

$cw = new CWByCityName('London');

/**
 * You can change the unit type before making the call.
 * The default value will be called from config file if there was no changes.
 */
$cw->setUnitType('imperial');

/**
 * You can also change the language before making the call
 * The default value will be called from config file if there was no changes.
 */ 
$cw->setLanguage('pl');

$cw->volUnit; // rain and snow volume unit | mm
$cw->presUnit; // pressure unit | hPa
$cw->distUnit; //Distance unit meter/sec | miles/hour
$cw->tempUnit; //Temperature unit Kelvin | Celsius | Fahrenheit.


$cw->get();
```


## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Mahmoud Osman](https://github.com/rawaby88)
- [All Contributors](../../contributors)

## License

[MIT](./LICENSE.md)
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
