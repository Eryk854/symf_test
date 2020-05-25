<?php

namespace App\Repository;

use App\Entity\Kierunek;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
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

    public function findByKierunekId($kierunek_id) {

        $sql = "SELECT id, nazwa, wydzial
                FROM kierunek
                WHERE id LIKE $kierunek_id";

        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('kierunek_id', 'kierunek_id')
            ->addScalarResult("nazwa", "nazwa")
            ->addScalarResult('wydzial', 'wydzial')
            ->addScalarResult('id', 'id');

        return $this->getEntityManager()
            ->createNativeQuery($sql, $rsm)
            ->getResult();
    }


}
