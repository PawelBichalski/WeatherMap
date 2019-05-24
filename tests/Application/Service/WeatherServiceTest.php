<?php

namespace App\Tests\Application\Service;

use App\Application\DTO\CityDTO;
use App\Application\DTO\WeatherAssembler;
use App\Application\DTO\WeatherDTO;
use App\Application\Service\WeatherService;
use App\Domain\ValueObject\Coordinates;
use App\Infrastructure\OpenWeather\OpenWeatherService;
use App\Infrastructure\Repository\CityRepository;
use App\Infrastructure\Repository\WeatherRepository;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    private $weatherService;

    private $openWeatherMock;
    private $weatherRepositoryMock;
    private $cityRepositoryMock;

    private $weatherDTO;

    public function setUp()
    {
        $this->weatherDTO = new WeatherDTO(
            '53.11',
            '13.11',
            new CityDTO(1, 'City 1'),
            21.1,
            11,
            10,
            'Description'
        );

        $this->openWeatherMock = $this->getMockBuilder(OpenWeatherService::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->openWeatherMock->expects($this->any())
            ->method('fetchData')
            ->with(new Coordinates('53.11', '13.11'))
            ->willReturn($this->weatherDTO);

        $this->weatherRepositoryMock = $this->getMockBuilder(WeatherRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cityRepositoryMock = $this->getMockBuilder(CityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->weatherService = new WeatherService(
            $this->openWeatherMock,
            $this->weatherRepositoryMock,
            $this->cityRepositoryMock,
            new WeatherAssembler()
        );

        parent::setUp();
    }

    public function testFetchFromOpenWeather()
    {
        $weatherDTO = $this->weatherService->fetchFromOpenWeather(
            new Coordinates('53.11', '13.11')
        );
        $this->assertSame($this->weatherDTO, $weatherDTO);
    }

    public function testAddWeather()
    {
        $this->weatherRepositoryMock = $this->getMockBuilder(WeatherRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->weatherRepositoryMock->expects($this->once())
            ->method('save');
        $this->weatherService = new WeatherService(
            $this->openWeatherMock,
            $this->weatherRepositoryMock,
            $this->cityRepositoryMock,
            new WeatherAssembler()
        );

        $this->weatherService->addWeather($this->weatherDTO);
    }
}
