<?php

namespace Rawaby88\OpenWeatherMap\Services;

use Orchestra\Testbench\TestCase;
use Rawaby88\OpenWeatherMap\Test\Traits\WorkWithWeatherClient;
use Rawaby88\OpenWeatherMap\Test\Traits\WorkWithWeatherDataSingleResult;

class CWByCityNameTest extends TestCase
{
    use WorkWithWeatherClient;
    use WorkWithWeatherDataSingleResult;

    protected $cw;                // init CWByCityName object
    public $getCurrentWeather; //used for initCall

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockHandler = $this->swapWeatherClient();

        $this->cw = new CWByCityName('warsaw');
    }

    private function initCall(): void
    {
        $this->mockHandler->append($this->mockSingleWeatherResponse());
        $this->getCurrentWeather = $this->cw->get();
    }
}
