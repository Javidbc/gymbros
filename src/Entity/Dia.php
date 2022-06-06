<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Dia
{
    public  function __construct(){
        $this->tablas = new ArrayCollection();
        $this->ejercicios = new ArrayCollection();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $diaSemana;

    /**
     * @ORM\ManyToMany(targetEntity="Tabla", mappedBy="dias")
     * @var Tabla[]|Collection
     */
    private $tablas;

    /**
     * @ORM\ManyToMany(targetEntity="Ejercicio", mappedBy="dias")
     * @var Ejercicio[]|Collection
     */
    private $ejercicios;

}