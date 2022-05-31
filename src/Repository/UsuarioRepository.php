<?php

namespace App\Repository;


use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioRepository  extends  ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    public function verUsuarios() : array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT u FROM App\\Entity\\Usuario u ORDER BY u.apellidos ASC")
            ->getResult();
    }
}