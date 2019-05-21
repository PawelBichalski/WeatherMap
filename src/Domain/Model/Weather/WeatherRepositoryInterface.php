<?php


namespace App\Domain\Model\Weather;

use App\Domain\Model\Weather\WeatherData;
use App\Application\Data\TemperatureStat;
use Pagerfanta\Pagerfanta;

/**
 * Interface WeatherRepositoryInterface
 * @package App\Domain\Model\Weather
 */
interface WeatherRepositoryInterface
{


    /**
     * @param WeatherData $weatherData
     */
    public function save(WeatherData $weatherData): void;

    /**
     * @param WeatherData $weatherData
     */
    public function remove(WeatherData $weatherData): void;

    public function getTemperatureStat(): TemperatureStat;

    public function countAll(): int;

    public function findLatest(int $page, int $pageSize): Pagerfanta;
}
