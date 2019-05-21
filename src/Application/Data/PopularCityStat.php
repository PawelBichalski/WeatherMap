<?php


namespace App\Application\Data;

use JMS\Serializer\Annotation as JMS;
use App\Application\DTO\CityDTO;

class PopularCityStat
{
    private $city;

    private $numData;

    /**
     * PopularCityStat constructor.
     * @param $city
     * @param $numData
     */
    public function __construct(CityDTO $city, int $numData)
    {
        $this->city = $city;
        $this->numData = $numData;
    }

    /**
     * @return CityDTO
     */
    public function getCity(): CityDTO
    {
        return $this->city;
    }

    /**
     * @return int
     */
    public function getNumData(): int
    {
        return $this->numData;
    }
}
