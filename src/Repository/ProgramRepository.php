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

    public function findAllGroupedByKierunekId()
    {
        $sql = "SELECT kierunek_id 
                FROM program
                GROUP BY kierunek_id";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('kierunek_id', 'kierunek_id');

        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }

    public function findAllOrderedByRokAkademicki()
    {
        $sql = "SELECT id, kierunek_id, opis, rok_akademicki, forma_studiow, poziom_studiow
                FROM program
                ORDER BY rok_akademicki desc";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('id', 'id')
            ->addScalarResult('kierunek_id', 'kierunek_id')
            ->addScalarResult('opis', 'opis')
            ->addScalarResult('rok_akademicki', 'rok_akademicki')
            ->addScalarResult('forma_studiow', 'forma_studiow')
            ->addScalarResult('poziom_studiow', 'poziom_studiow');

        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }
}