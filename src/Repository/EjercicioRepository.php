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

    public function verEjercicios() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT e FROM App\\Entity\\Ejercicio e ORDER BY e.nombre DESC")
            ->getResult();
    }
}
