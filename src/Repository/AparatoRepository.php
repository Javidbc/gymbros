<?php

namespace App\Repository;

use App\Entity\Aparato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AparatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aparato::class);
    }
    public function verAparatos():array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Aparato a")
            ->getResult();
    }
}