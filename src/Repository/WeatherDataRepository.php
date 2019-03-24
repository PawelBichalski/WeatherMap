<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\WeatherData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;

/**
 * @method WeatherData|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherData|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherData[]    findAll()
 * @method WeatherData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, WeatherData::class);
    }

    public function findLatest (int $page=1, int $pageSize=10): Pagerfanta
    {
        $queryBuilder = $this->createQueryBuilder('d')
            ->join(City::class, 'c')
            ->orderBy('d.date', 'DESC');

        $paginator = new Pagerfanta(new DoctrineORMAdapter($queryBuilder->getQuery()));
        $paginator->setMaxPerPage($pageSize);
        $paginator->setCurrentPage($page);

        return $paginator;
    }

    public function getTemperatureStat ()
    {
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->select([
            'MIN(s.temperature) AS minTemperature',
            'MAX(s.temperature) AS maxTemperature',
            'AVG(s.temperature) AS avgTemperature'
        ]);
        $queryBuilder->setMaxResults(1);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }

    // /**
    //  * @return WeatherData[] Returns an array of WeatherData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeatherData
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
