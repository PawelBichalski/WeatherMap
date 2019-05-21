<?php

namespace App\Repository;

use App\Domain\Model\City\City;
use App\Domain\Model\Weather\WeatherData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\AST\Join;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, City::class);
    }

    public function findMostPopularCity()
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->innerJoin(WeatherData::class, 'd')
            ->select('c AS city, COUNT(DISTINCT d.id) AS numData')
            ->andWhere('c.id=d.city')
            ->groupBy('d.city')
            ->orderBy('numData', 'DESC')
            ->setMaxResults(1);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}
