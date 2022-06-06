<?php

namespace App\Repository;

use App\Entity\Reserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserva::class);
    }

    public function nuevo() : Reserva
    {
        $reserva = new Reserva();
        $this->getEntityManager()->persist($reserva);
        return $reserva;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Reserva $reserva):void
    {
        $this->getEntityManager()->remove($reserva);
        $this->save();
    }

    public function verReservas() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT r FROM App\\Entity\\Reserva r ORDER BY r.fechaReserva DESC")
            ->getResult();
    }
}