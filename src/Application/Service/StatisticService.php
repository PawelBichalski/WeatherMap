<?php


namespace App\Application\Service;

use App\Application\Data\PopularCityStat;
use App\Application\Data\WeatherStat;
use App\Application\DTO\CityAssembler;
use App\Domain\Model\Weather\WeatherRepositoryInterface;
use App\Domain\Model\City\CityRepositoryInterface;

class StatisticService
{
    private $weatherRepository;

    private $cityRepository;

    private $cityAssembler;

    public function __construct(
        WeatherRepositoryInterface $weatherRepository,
        CityRepositoryInterface $cityRepository,
        CityAssembler $cityAssembler
    ) {
        $this->weatherRepository = $weatherRepository;
        $this->cityRepository = $cityRepository;
        $this->cityAssembler = $cityAssembler;
    }

    public function getStats(): WeatherStat
    {
        $mostPopularData = $this->cityRepository->findMostPopularCity();

        return new WeatherStat(
            $this->weatherRepository->getTemperatureStat(),
            new PopularCityStat(
                $this->cityAssembler->writeDTO($mostPopularData['city']),
                $mostPopularData['numData']
            ),
            $this->weatherRepository->countAll()
        );
    }
}
