<?php

namespace App\Repository;

use App\Entity\Kierunek;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kierunek|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kierunek|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kierunek[]    findAll()
 * @method Kierunek[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KierunekRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kierunek::class);
    }

    // /**
    //  * @return Kierunek[] Returns an array of Kierunek objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kierunek
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
