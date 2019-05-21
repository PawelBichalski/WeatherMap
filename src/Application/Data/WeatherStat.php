<?php


namespace App\Application\Data;

use JMS\Serializer\Annotation as JMS;

class WeatherStat
{
    private $temperature;

    private $mostPopularCity;

    private $dataCount;

    /**
     * WeatherStat constructor.
     * @param $temperature
     * @param $mostPopularCity
     * @param $dataCount
     */
    public function __construct(TemperatureStat $temperature, PopularCityStat $mostPopularCity, int $dataCount)
    {
        $this->temperature = $temperature;
        $this->mostPopularCity = $mostPopularCity;
        $this->dataCount = $dataCount;
    }

    /**
     * @return TemperatureStat
     */
    public function getTemperature(): TemperatureStat
    {
        return $this->temperature;
    }

    /**
     * @return PopularCityStat
     */
    public function getMostPopularCity(): PopularCityStat
    {
        return $this->mostPopularCity;
    }

    /**
     * @return int
     */
    public function getDataCount(): int
    {
        return $this->dataCount;
    }
}
