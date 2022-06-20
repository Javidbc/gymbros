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

    public function horariosDisponibles($fecha,$maquina):array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT h FROM App\\Entity\\Horario h WHERE h NOT IN(SELECT (r.horario) FROM App\\Entity\\Reserva r WHERE r.fechaReserva =:fecha AND r.maquina =:maquina)")
            ->setParameter('fecha',$fecha)
            ->setParameter('maquina',$maquina)
            ->getResult();
    }

    public function maquinasDisponibles($fecha,$horario,$aparato):array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT m FROM App\\Entity\\Maquina m WHERE m.aparato =:aparato AND m NOT IN(SELECT (r.maquina) FROM App\\Entity\\Reserva r WHERE r.fechaReserva =:fecha AND r.horario =:horario)")
            ->setParameter('aparato',$aparato)
            ->setParameter('fecha',$fecha)
            ->setParameter('horario',$horario)
            ->getResult();
    }
}