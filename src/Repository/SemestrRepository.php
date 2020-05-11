<?php

namespace App\Repository;

use App\Entity\Semestr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Semestr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Semestr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Semestr[]    findAll()
 * @method Semestr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SemestrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Semestr::class);
    }

    // /**
    //  * @return Semestr[] Returns an array of Semestr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Semestr
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
