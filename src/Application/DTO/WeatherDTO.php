<?php


namespace App\Application\DTO;

/**
 * Class WeatherDTO
 * @package App\Application\DTO
 */
class WeatherDTO
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var CityDTO
     */
    private $city;

    /**
     * @var float
     */
    private $temperature;

    /**
     * @var int
     */
    private $clouds;

    /**
     * @var float
     */
    private $wind;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTimeInterface
     */
    private $date;

    /**
     * WeatherDTO constructor.
     * @param string $latitude
     * @param string $longitude
     * @param CityDTO $city
     * @param float $temperature
     * @param int $clouds
     * @param float $wind
     * @param string $description
     * @param \DateTimeInterface|null $date
     * @param int|null $id
     */
    public function __construct(
        string $latitude,
        string $longitude,
        CityDTO $city,
        float $temperature,
        int $clouds,
        float $wind,
        string $description,
        \DateTimeInterface $date = null,
        int $id = null
    ) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->city = $city;
        $this->temperature = $temperature;
        $this->clouds = $clouds;
        $this->wind = $wind;
        $this->description = $description;
        $this->date = $date;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @return CityDTO
     */
    public function getCity(): CityDTO
    {
        return $this->city;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return int
     */
    public function getClouds(): int
    {
        return $this->clouds;
    }

    /**
     * @return float
     */
    public function getWind(): float
    {
        return $this->wind;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @return int|null
     */

    public function getId(): ?int
    {
        return $this->id;
    }
}
