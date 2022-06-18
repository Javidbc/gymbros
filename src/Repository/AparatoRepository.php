<?php

namespace App\Repository;

use App\Entity\Aparato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AparatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aparato::class);
    }
    public function nuevo() : Aparato
    {
        $aparato = new Aparato();
        $this->getEntityManager()->persist($aparato);
        return $aparato;
    }

    public function save():void
    {
        $this->getEntityManager()->flush();
    }

    public function delete(Aparato $aparato):void
    {
        $this->getEntityManager()->remove($aparato);
        $this->save();
    }

    public function verAparatos():array
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Aparato a")
            ->getResult();
    }
    public function verAparato(string $aparato)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Aparato a WHERE a.id = :id")
            ->setParameter('id',$aparato)
            ->getResult();
    }

    public function recogerAparatos(string $buscar)
    {
        return $this
            ->getEntityManager()
            ->createQuery("SELECT a FROM App\\Entity\\Aparato a WHERE a.nombreAparato LIKE :busqueda")
            ->setParameter('busqueda','%'. $buscar .'%')
            ->getResult();
    }


}