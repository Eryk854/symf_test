<?php

namespace App\Repository;

use App\Entity\Sylabus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @method Sylabus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sylabus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sylabus[]    findAll()
 * @method Sylabus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SylabusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sylabus::class);
    }

    public function findOneByNumerKatalogowy($value): ?Sylabus
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.numerKatalogowy = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function findOneByZajecia($value): ?Sylabus
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.zajecia = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }

}
