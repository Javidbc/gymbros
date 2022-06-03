<?php

namespace App\Repository;

use App\Entity\Maquina;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MaquinaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maquina::class);
    }

    public function nuevo() : Maquina
    {
        $maquina = new Maquina();
        $this->getEntityManager()->persist($maquina);
        return $maquina;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Maquina $maquina):void
    {
        $this->getEntityManager()->remove($maquina);
        $this->save();
    }

    public function verMaquinas() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT m FROM App\\Entity\\Maquina m")
            ->getResult();
    }
}