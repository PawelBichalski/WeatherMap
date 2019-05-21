<?php


namespace App\Application\Service;

use App\Application\DTO\WeatherAssembler;
use App\Application\DTO\WeatherDTO;
use App\Domain\Model\City\CityRepositoryInterface;
use App\Domain\Model\Weather\WeatherData;
use App\Domain\Model\Weather\WeatherRepositoryInterface;
use App\Domain\ValueObject\Coordinates;
use App\Infrastructure\OpenWeather\OpenWeatherService;

/**
 * Class WeatherService
 * @package App\Application\Service
 */
class WeatherService
{
    /**
     * @var OpenWeatherService
     */
    private $openWeatherService;
    /**
     * @var WeatherRepositoryInterface
     */
    private $weatherRepository;

    /**
     * @var CityRepositoryInterface
     */
    private $cityRepository;

    /**
     * @var WeatherAssembler
     */
    private $weatherAssembler;

    /**
     * WeatherService constructor.
     * @param WeatherRepositoryInterface $weatherRepository
     * @param CityRepositoryInterface $cityRepository
     * @param WeatherAssembler $weatherAssembler
     */
    public function __construct(
        OpenWeatherService $openWeatherService,
        WeatherRepositoryInterface $weatherRepository,
        CityRepositoryInterface $cityRepository,
        WeatherAssembler $weatherAssembler
    ) {
        $this->openWeatherService = $openWeatherService;
        $this->weatherRepository = $weatherRepository;
        $this->cityRepository = $cityRepository;
        $this->weatherAssembler = $weatherAssembler;
    }

    public function fetchFromOpenWeather(Coordinates $coordinates)
    {
        return $this->openWeatherService->fetchData($coordinates);
    }

    /**
     * @param WeatherDTO $weatherDTO
     * @return WeatherData
     */
    public function addWeather(WeatherDTO $weatherDTO): WeatherDTO
    {
        $weatherData = $this->weatherAssembler->createWeather($weatherDTO);
        $cityExists = $this->cityRepository->findById($weatherData->getCity()->getId());
        if ($cityExists) {
            $weatherData->setCity($cityExists);
        }

        $this->weatherRepository->save($weatherData);
        return $this->weatherAssembler->writeDTO($weatherData);
    }
}
