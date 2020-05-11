<?php

namespace App\Repository;

use App\Entity\Literatura;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Literatura|null find($id, $lockMode = null, $lockVersion = null)
 * @method Literatura|null findOneBy(array $criteria, array $orderBy = null)
 * @method Literatura[]    findAll()
 * @method Literatura[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LiteraturaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Literatura::class);
    }

    // /**
    //  * @return Literatura[] Returns an array of Literatura objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Literatura
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
