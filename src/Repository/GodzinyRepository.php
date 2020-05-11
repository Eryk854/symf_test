<?php

namespace App\Repository;

use App\Entity\Godziny;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Godziny|null find($id, $lockMode = null, $lockVersion = null)
 * @method Godziny|null findOneBy(array $criteria, array $orderBy = null)
 * @method Godziny[]    findAll()
 * @method Godziny[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GodzinyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Godziny::class);
    }

    // /**
    //  * @return Godziny[] Returns an array of Godziny objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Godziny
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
