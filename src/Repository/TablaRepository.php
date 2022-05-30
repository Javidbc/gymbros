<?php

namespace App\Repository;

use App\Entity\Tabla;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TablaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tabla::class);
    }

    public function verTablas() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT t FROM App\\Entity\\Tabla t ORDER BY t.nombreTabla DESC")
            ->getResult();
    }
}