<?php


namespace App\Application\DTO;

use App\Domain\Model\City\City;

/**
 * Class CityAssembler
 * @package App\Application\DTO
 */
class CityAssembler
{
    /**
     * @param CityDTO $cityDTO
     * @param City|null $city
     * @return City
     */

    public function readDTO(CityDTO $cityDTO, ?City $city = null): City
    {
        if (!$city) {
            $city = new City();
        }
        $city->setId($cityDTO->getId());
        $city->setName($cityDTO->getName());

        return $city;
    }

    /**
     * @param CityDTO $cityDTO
     * @return City
     */

    public function createCity(CityDTO $cityDTO): City
    {
        return $this->readDTO($cityDTO);
    }

    /**
     * @param City $city
     * @return CityDTO
     */

    public function writeDTO(City $city): CityDTO
    {
        return new CityDTO($city->getId(), $city->getName());
    }
}
