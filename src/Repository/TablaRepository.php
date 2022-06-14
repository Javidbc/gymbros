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
    public function nuevo() : Tabla
    {
        $tabla = new Tabla();
        $this->getEntityManager()->persist($tabla);
        return $tabla;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Tabla $tabla):void
    {
        $this->getEntityManager()->remove($tabla);
        $this->save();
    }

    public function verTablas() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT t FROM App\\Entity\\Tabla t ORDER BY t.nombreTabla DESC")
            ->getResult();
    }

    public function verTabla(string $tabla)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT t FROM App\\Entity\\Tabla t WHERE t.id = :id")
            ->setParameter('id',$tabla)
            ->getResult();
    }

    public function verTablasUser(string $usuario) : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT t FROM App\\Entity\\Tabla t WHERE t.creador = :usuario OR t.vistoBueno = true ORDER BY t.nombreTabla DESC")
            ->setParameter('usuario',$usuario)
            ->getResult();
    }
}