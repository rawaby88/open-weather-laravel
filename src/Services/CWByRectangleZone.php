<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Rawaby88\OpenWeatherMap\Interfaces\CWMultiResultInterface;
use Rawaby88\OpenWeatherMap\Traits\CWMultiResultTrait;
use Rawaby88\OpenWeatherMap\WeatherFactory;

/**
 * Class CWByRectangleZone.
 */
class CWByRectangleZone extends WeatherFactory implements CWMultiResultInterface
{
    use CWMultiResultTrait;

    /**
     * @var float Bounding box lon-left.
     */
    protected $lonLeft;

    /**
     * @var float Bounding box lat-bottom.
     */
    protected $latBottom;

    /**
     * @var float Bounding box lon-right.
     */
    protected $lonRight;

    /**
     * @var float Bounding box lat-top.
     */
    protected $latTop;

    /**
     * @var float Bounding box zoom.
     */
    protected $zoom;

    /**
     * CWByRectangleZone constructor.
     *
     * returns the data from cities within the defined rectangle specified by the geographic coordinates.
     * There is a limit of 25 square degrees for Free and Startup plans.
     *
     * @param float $lonLeft Bounding box lon-left.
     * @param float $latBottom Bounding box lat-bottom.
     * @param float $lonRight Bounding box lon-right.
     * @param float $latTop Bounding box lat-top.
     * @param float $zoom Bounding box zoom.
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct(float $lonLeft, float $latBottom, float $lonRight, float $latTop, float $zoom)
    {
        parent::__construct();
        $this->apiCall = 'box/city';
        $this->lonLeft = $lonLeft;
        $this->latBottom = $latBottom;
        $this->lonRight = $lonRight;
        $this->latTop = $latTop;
        $this->zoom = $zoom;
        $this->params = $this->paramsToArray();
    }

    /**
     * Generate query parameters for api call.
     * @return array
     */
    private function paramsToArray(): array
    {
        $box = $this->lonLeft.','.$this->latBottom.','.$this->lonRight.','.$this->latTop.','.$this->zoom;

        return ['bbox' => $box];
    }
}
