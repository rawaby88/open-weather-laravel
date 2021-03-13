<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base url
    |--------------------------------------------------------------------------
    |
    | This is the base url for each call to Open Weather Map service
    |
    | For more information visit: https://openweathermap.org/current
    */
    'base_uri'     => env('WEATHER_API_BASE_URI', 'api.openweathermap.org/data/2.5/'),

    /*
    |--------------------------------------------------------------------------
    | API Token
    |--------------------------------------------------------------------------
    |
    | To use this package you'll need to register into Open Weather Map service
    | and generate an API Key.
    |
    | For more information visit: https://home.openweathermap.org/api_keys
    */
    'api_token'    => env('WEATHER_API_TOKEN', 'be494625fd2bc4cfd3f44717c1add737'),

    /*
    |--------------------------------------------------------------------------
    | Api Icon Url
    |--------------------------------------------------------------------------
    |
    | To display the icons that sent from the API.
    |	Day icon	Night icon	Description
    |	01d.png 	01n.png 	clear sky
    |	02d.png 	02n.png 	few clouds
    |	03d.png 	03n.png 	scattered clouds
    |	04d.png 	04n.png 	broken clouds
    |	09d.png 	09n.png 	shower rain
    |	10d.png 	10n.png 	rain
    |	11d.png 	11n.png 	thunderstorm
    |	13d.png 	13n.png 	snow
    |	50d.png 	50n.png 	mist
    |
    | For more information visit: https://openweathermap.org/weather-conditions
    */
    'api_icon_url' => '//openweathermap.org/img/w/%s.png',

    /*
    |--------------------------------------------------------------------------
    | Units formatting
    |--------------------------------------------------------------------------
    |
    |	Temperature is available in Fahrenheit, Celsius and Kelvin units.
    |
    |	For temperature in Fahrenheit use units=imperial
    |	For temperature in Celsius use units=metric
    |	Temperature in Kelvin is used by default, no need to use units parameter in API call
    |
    |
    | List of all API parameters with units https://openweathermap.org/weather-data
    */
    'unit'         => 'metric',

    /*
    |--------------------------------------------------------------------------
    | Language
    |--------------------------------------------------------------------------
    |
    | You can use language parameter to get the output in your language.
    | Open Weather Map supports the following languages that you can use with
    | the corresponded lang values:
    | af Afrikaans
    | al Albanian
    | ar Arabic
    | az Azerbaijani
    | bg Bulgarian
    | ca Catalan
    | cz Czech
    | da Danish
    | de German
    | el Greek
    | en English
    | eu Basque
    | fa Persian (Farsi)
    | fi Finnish
    | fr French
    | gl Galician
    | he Hebrew
    | hi Hindi
    | hr Croatian
    | hu Hungarian
    | id Indonesian
    | it Italian
    | ja Japanese
    | kr Korean
    | la Latvian
    | lt Lithuanian
    | mk Macedonian
    | no Norwegian
    | nl Dutch
    | pl Polish
    | pt Portuguese
    | pt_br Português Brasil
    | ro Romanian
    | ru Russian
    | sv, se Swedish
    | sk Slovak
    | sl Slovenian
    | sp, es Spanish
    | sr Serbian
    | th Thai
    | tr Turkish
    | ua, uk Ukrainian
    | vi Vietnamese
    | zh_cn Chinese Simplified
    | zh_tw Chinese Traditional
    | zu Zulu
    |
    | IMPORTANT: Translation is only applied for the "description" field.
    */
    'language'     => 'en',
];
