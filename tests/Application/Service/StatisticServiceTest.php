<?php

namespace App\Tests\Application\Service;

use App\Application\Data\TemperatureStat;
use App\Application\Data\WeatherStat;
use App\Application\DTO\CityAssembler;
use App\Application\Service\StatisticService;
use App\Domain\Model\City\City;
use App\Infrastructure\Repository\WeatherRepository;
use App\Infrastructure\Repository\CityRepository;
use PHPUnit\Framework\TestCase;

class StatisticServiceTest extends TestCase
{
    private $statisticService;
    private $weatherRepositoryMock;
    private $cityRepositoryMock;

    public function setUp()
    {
        $this->weatherRepositoryMock = $this->getMockBuilder(WeatherRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->weatherRepositoryMock->method('getTemperatureStat')
            ->willReturn(new TemperatureStat(1, 3, 2));
        $this->weatherRepositoryMock->method('countAll')
            ->willReturn(2);

        $this->cityRepositoryMock = $this->getMockBuilder(CityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $fakeCity = new City();
        $fakeCity->setId(1);
        $fakeCity->setName('City');
        $this->cityRepositoryMock->method('findMostPopularCity')
            ->willReturn(['city' => $fakeCity, 'numData' => 2]);

        $this->statisticService = new StatisticService(
            $this->weatherRepositoryMock,
            $this->cityRepositoryMock,
            new CityAssembler()
        );

        parent::setUp();
    }

    public function testGetStats()
    {
        $statData = $this->statisticService->getStats();

        $this->assertInstanceOf(WeatherStat::class, $statData);
        $this->assertEquals(1, $statData->getTemperature()->getMin());
        $this->assertEquals(3, $statData->getTemperature()->getMax());
        $this->assertEquals(2, $statData->getTemperature()->getAvg());

        $this->assertEquals(1, $statData->getMostPopularCity()->getCity()->getId());
        $this->assertEquals('City', $statData->getMostPopularCity()->getCity()->getName());

        $this->assertEquals(2, $statData->getMostPopularCity()->getNumData());
        $this->assertEquals(2, $statData->getDataCount());
    }
}
