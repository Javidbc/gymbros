<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Aparato
{
    public function  __construct()
    {
        $this->ejercicios = new ArrayCollection();
        $this->maquinas  = new ArrayCollection();
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
    private $nombreAparato;

    /**
     * @ORM\Column (type="boolean")
     * @var boolean
     */
    private $reservable;

    /**
     * @ORM\ManyToMany(targetEntity="Ejercicio", inversedBy="aparatos")
     * @var Ejercicio[]|Collection
     */
    private $ejercicios;

    /**
     * @ORM\OneToMany(targetEntity="Maquina",mappedBy="aparato")
     * @var Maquina[]|Collection
     */
    private $maquinas;


}