<?php

namespace App\Repository;

use App\Entity\Dia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dia::class);
    }

    public function nuevo() : Dia
    {
        $dia = new Dia();
        $this->getEntityManager()->persist($dia);
        return $dia;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Dia $dia):void
    {
        $this->getEntityManager()->remove($dia);
        $this->save();
    }

    public function verDias(): array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT d FROM App\\Entity\\Dia d ")
            ->getResult();
    }
}