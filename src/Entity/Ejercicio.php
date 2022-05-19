<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Ejercicio
{
    public  function __construct(){
        $this->aparatos = new ArrayCollection();
        $this->tablas = new ArrayCollection();
        $this->series = new ArrayCollection();
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
    private $nombre;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $grupoMuscular;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $url;

    /**
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="ejercicio")
     * @var Serie[]|Collection
     */
    private $series;

    /**
     * @ORM\ManyToMany(targetEntity="Aparato", mappedBy="ejercicios")
     * @var Aparato[]|Collection
     */
    private $aparatos;

    /**
     * @ORM\ManyToMany(targetEntity="Tabla", mappedBy="ejercicios")
     * @var Tabla[]|Collection
     */
    private $tablas;



}