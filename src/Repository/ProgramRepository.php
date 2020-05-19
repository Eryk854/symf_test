<?php

namespace App\Repository;

use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Program|null find($id, $lockMode = null, $lockVersion = null)
 * @method Program|null findOneBy(array $criteria, array $orderBy = null)
 * @method Program[]    findAll()
 * @method Program[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Program::class);
    }

    public function findAllGroupedByRokAkademicki()
    {
        $sql = "SELECT rok_akademicki 
                FROM program 
                GROUP BY rok_akademicki";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('rok_akademicki', 'rok_akademicki');

        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }

    public function findAllGroupedByFormaStudiow()
    {
        $sql = "SELECT forma_studiow 
                FROM program 
                GROUP BY forma_studiow";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('forma_studiow', 'forma_studiow');

        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }

    public function findAllGroupedByPoziomStudiow()
    {
        $sql = "SELECT poziom_studiow 
                FROM program 
                GROUP BY poziom_studiow";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('poziom_studiow', 'poziom_studiow');

        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }
}