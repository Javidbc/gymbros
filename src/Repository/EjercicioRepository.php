<?php
namespace App\Repository;

use App\Entity\Ejercicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EjercicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ejercicio::class);
    }

    public function nuevo() : Ejercicio
    {
        $ejercicio = new Ejercicio();
        $this->getEntityManager()->persist($ejercicio);
        return $ejercicio;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Ejercicio $ejercicio):void
    {
        $this->getEntityManager()->remove($ejercicio);
        $this->save();
    }

    public function verEjercicios() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT e FROM App\\Entity\\Ejercicio e ORDER BY e.nombre DESC")
            ->getResult();
    }
}
