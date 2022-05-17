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
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $reservable;

    /**
     * @ORM\OneToMany(targetEntity="Serie", mappedBy="ejercicio")
     */
    private $serie;

    /**
     * @ORM\ManyToMany(targetEntity="Aparato", mappedBy="ejercicio")
     * @var Aparato[]|Collection
     */
    private $aparatos;

    /**
     * @ORM\ManyToMany(targetEntity="Tabla", mappedBy="ejercicio")
     * @var Tabla[]|Collection
     */
    private $tablas;



}