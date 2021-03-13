<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Orchestra\Testbench\TestCase;
use Rawaby88\OpenWeatherMap\Test\Traits\WorkWithWeatherClient;
use Rawaby88\OpenWeatherMap\Test\Traits\WorkWithWeatherDataSeveralResult;

class CWByRectangleZoneTest extends TestCase
{
    use WorkWithWeatherClient;
    use WorkWithWeatherDataSeveralResult;

    protected $cw;                // init CWByCityName object
    public $getCurrentWeather; //used for initCall

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = $this->swapWeatherClient();

        try {
            $this->cw = new CWByRectangleZone(12, 32, 15, 37, 10);
        } catch (BindingResolutionException $e) {
        }
    }

    private function initCall(): void
    {
        $this->mockHandler->append($this->mockSeveralWeatherResponse());

        $this->getCurrentWeather = $this->cw->get()
                                            ->first();
    }
}
