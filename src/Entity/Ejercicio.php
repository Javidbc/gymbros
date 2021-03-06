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
        $this->series = new ArrayCollection();
        $this->aparatos = new ArrayCollection();
        $this->dias = new ArrayCollection();
    }
    public function  __toString()
    {
        return $this->getNombre();
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
     * @ORM\ManyToMany(targetEntity="Aparato", inversedBy="ejercicios")
     * @var Aparato[]|Collection
     */
    private $aparatos;

    /**
     * @ORM\ManyToMany(targetEntity="Dia", mappedBy="ejercicios")
     * @var Dia[]|Collection
     */
    private $dias;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     * @return Ejercicio
     */
    public function setNombre(string $nombre): Ejercicio
    {
        $this->nombre = $nombre;
        return $this;
    }

    /**
     * @return string
     */
    public function getGrupoMuscular(): ?string
    {
        return $this->grupoMuscular;
    }

    /**
     * @param string $grupoMuscular
     * @return Ejercicio
     */
    public function setGrupoMuscular(string $grupoMuscular): Ejercicio
    {
        $this->grupoMuscular = $grupoMuscular;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     * @return Ejercicio
     */
    public function setDescripcion(string $descripcion): Ejercicio
    {
        $this->descripcion = $descripcion;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Ejercicio
     */
    public function setUrl(string $url): Ejercicio
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return Serie[]|Collection
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param Serie[]|Collection $series
     * @return Ejercicio
     */
    public function setSeries($series)
    {
        $this->series = $series;
        return $this;
    }

    /**
     * @return Aparato[]|Collection
     */
    public function getAparatos()
    {
        return $this->aparatos;
    }

    /**
     * @param Aparato[]|Collection $aparatos
     * @return Ejercicio
     */
    public function setAparatos($aparatos)
    {
        $this->aparatos = $aparatos;
        return $this;
    }

    /**
     * @return Dia[]|Collection
     */
    public function getDias()
    {
        return $this->dias;
    }

    /**
     * @param Dia[]|Collection $dias
     * @return Ejercicio
     */
    public function setDias($dias)
    {
        $this->dias = $dias;
        return $this;
    }





}