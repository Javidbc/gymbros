<?php

namespace App\Repository;

use App\Entity\Horario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class HorarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Horario::class);
    }

    public function nuevo() : Horario
    {
        $horario = new Horario();
        $this->getEntityManager()->persist($horario);
        return $horario;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Horario $horario):void
    {
        $this->getEntityManager()->remove($horario);
        $this->save();
    }

    public function verHorarios() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT h FROM App\\Entity\\Horario h ORDER BY h.hora DESC")
            ->getResult();
    }
}