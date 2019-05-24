<?php

namespace App\Tests\Infrastructure\OpenWeather;

use App\Application\DTO\WeatherDTO;
use App\Domain\ValueObject\Coordinates;
use App\Infrastructure\OpenWeather\OpenWeatherService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OpenWeatherServiceTest extends KernelTestCase
{

    public function testFetchData()
    {
        self::bootKernel();

        $container = self::$container;

        $service = self::$container->get('App\Infrastructure\OpenWeather\OpenWeatherService');
        $weatherDTO = $service->fetchData(new Coordinates('53.11', '13.11'));
        $this->assertInstanceOf(WeatherDTO::class, $weatherDTO);
    }
}
