<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Orchestra\Testbench\TestCase;
use Rawaby88\OpenWeatherMap\Test\Traits\WorkWithWeatherClient;
use Rawaby88\OpenWeatherMap\Test\Traits\WorkWithWeatherDataSingleResult;

class CWByCityIdTest extends TestCase
{
    use WorkWithWeatherClient;
    use WorkWithWeatherDataSingleResult;

    protected $cw;                // init CWByCityName object
    public $getCurrentWeather; //used for initCall

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = $this->swapWeatherClient();

        try {
            $this->cw = new CWByCityId(12345);
        } catch (BindingResolutionException $e) {
        }
    }

    private function initCall(): void
    {
        $this->mockHandler->append($this->mockSingleWeatherResponse());

        $this->getCurrentWeather = $this->cw->get();
    }
}
