<?php

namespace App\Repository;

use App\Entity\Arrivals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Arrivals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Arrivals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Arrivals[]    findAll()
 * @method Arrivals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArrivalsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Arrivals::class);
    }

    // /**
    //  * @return Arrivals[] Returns an array of Arrivals objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Arrivals
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
