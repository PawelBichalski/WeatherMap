<?php

namespace App\Domain\Model\City;

use App\Application\Data\PopularCityStat;
use App\Domain\Model\City\City;

/**
 * Interface CityRepositoryInterface
 * @package App\Domain\Model\City
 */
interface CityRepositoryInterface
{
    /**
     * @param int $cityId
     * @return City|null
     */
    public function findById(int $cityId): ?City;

    /**
     * @param City $city
     */
    public function save(City $city): void;

    public function findMostPopularCity();
}
