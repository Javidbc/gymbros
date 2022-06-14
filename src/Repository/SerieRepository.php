<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SerieRepository  extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }
    public function nuevo() : Serie
    {
        $serie = new Serie();
        $this->getEntityManager()->persist($serie);
        return $serie;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Serie $serie):void
    {
        $this->getEntityManager()->remove($serie);
        $this->save();
    }

    public function verMisSeries(string $usuario,string $fecha)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT s FROM App\\Entity\\Serie s WHERE s.usuario = :usuario AND s.fechaSerie = :fecha")
            ->setParameter('usuario',$usuario)
            ->setParameter('fecha',$fecha)
            ->getResult();
    }

    public function seriesHoy(string $usuario,string $fecha,string $ejercicio)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT s FROM App\\Entity\\Serie s WHERE s.usuario = :usuario AND s.fechaSerie = :fecha AND s.ejercicio = :ejercicio")
            ->setParameter('usuario',$usuario)
            ->setParameter('fecha',$fecha)
            ->setParameter('ejercicio',$ejercicio)
            ->getResult();
    }
}