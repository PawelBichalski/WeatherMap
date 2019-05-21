<?php


namespace App\Infrastructure\Repository;

use App\Domain\Model\Weather\WeatherRepositoryInterface;
use App\Domain\Model\Weather\WeatherData;
use App\Application\Data\TemperatureStat;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Pagerfanta\Pagerfanta;

class WeatherRepository implements WeatherRepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $objectRepository;

    /**
     * WeatherRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->objectRepository = $this->entityManager->getRepository(WeatherData::class);
    }


    /**
     * @param WeatherData $weatherData
     */
    public function save(WeatherData $weatherData): void
    {
        $this->entityManager->persist($weatherData);
        $this->entityManager->flush();
    }

    /**
     * @param WeatherData $weatherData
     */
    public function remove(WeatherData $weatherData): void
    {
        $this->entityManager->remove($weatherData);
        $this->entityManager->flush();
    }

    public function getTemperatureStat(): TemperatureStat
    {
        $temperatureStat = $this->objectRepository->getTemperatureStat();
        return new TemperatureStat(
            $temperatureStat['minTemperature'],
            $temperatureStat['maxTemperature'],
            $temperatureStat['avgTemperature']
        );
    }

    public function countAll(): int
    {
        return $this->objectRepository->count([]);
    }

    public function findLatest(int $page, int $pageSize): Pagerfanta
    {
        return $this->objectRepository->findLatest($page, $pageSize);
    }
}
