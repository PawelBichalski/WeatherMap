<?php


namespace App\Application\DTO;

use App\Domain\Model\Weather\WeatherData;
use App\Domain\ValueObject\Coordinates;

/**
 * Class WeatherAssembler
 * @package App\Application\DTO
 */
class WeatherAssembler
{
    /**
     * @param WeatherDTO $weatherDTO
     * @param WeatherData|null $weatherData
     * @return WeatherData
     */

    public function readDTO(WeatherDTO $weatherDTO, ?WeatherData $weatherData = null): WeatherData
    {
        if (!$weatherData) {
            $weatherData = new WeatherData();
        }
        $weatherData->setCoordinates(new Coordinates(
            $weatherDTO->getLatitude(),
            $weatherDTO->getLongitude()
        ));
        $cityAssembler = new CityAssembler();
        $weatherData->setCity($cityAssembler->readDTO($weatherDTO->getCity()));
        $weatherData->setTemperature($weatherDTO->getTemperature());
        $weatherData->setClouds($weatherDTO->getClouds());
        $weatherData->setWind($weatherDTO->getWind());
        $weatherData->setDescription($weatherDTO->getDescription());

        return $weatherData;
    }

    /**
     * @param WeatherDTO $weatherDTO
     * @return WeatherData
     */
    public function createWeather(WeatherDTO $weatherDTO): WeatherData
    {
        return $this->readDTO($weatherDTO);
    }

    /**
     * @param WeatherData $weatherData
     * @return WeatherDTO
     */
    public function writeDTO(WeatherData $weatherData): WeatherDTO
    {
        $cityAssembler = new CityAssembler();
        return new WeatherDTO(
            $weatherData->getCoordinates()->getLatitude(),
            $weatherData->getCoordinates()->getLongitude(),
            $cityAssembler->writeDTO($weatherData->getCity()),
            $weatherData->getTemperature(),
            $weatherData->getClouds(),
            $weatherData->getWind(),
            $weatherData->getDescription(),
            $weatherData->getDate(),
            $weatherData->getId()
        );
    }
}
