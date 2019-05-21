<?php


namespace App\Infrastructure\Repository;

use App\Application\Data\PopularCityStat;
use App\Domain\Model\City\City;
use App\Domain\Model\City\CityRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CityRepository
 * @package App\Infrastructure\Repository
 */
class CityRepository implements CityRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(City::class);
    }

    /**
     * @param int $cityId
     * @return City|null
     */
    public function findById(int $cityId): ?City
    {
        return $this->objectRepository->find($cityId);
    }

    /**
     * @param City $city
     */
    public function save(City $city): void
    {
        $this->entityManager->persist($city);
        $this->entityManager->flush();
    }

    public function findMostPopularCity()
    {
        return $this->objectRepository->findMostPopularCity();
    }
}
