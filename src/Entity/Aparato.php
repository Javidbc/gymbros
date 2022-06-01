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

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Aparato
     */
    public function setId(int $id): Aparato
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNombreAparato(): ?string
    {
        return $this->nombreAparato;
    }

    /**
     * @param string $nombreAparato
     * @return Aparato
     */
    public function setNombreAparato(string $nombreAparato): Aparato
    {
        $this->nombreAparato = $nombreAparato;
        return $this;
    }

    /**
     * @return bool
     */
    public function isReservable(): ?bool
    {
        return $this->reservable;
    }

    /**
     * @param bool $reservable
     * @return Aparato
     */
    public function setReservable(bool $reservable): Aparato
    {
        $this->reservable = $reservable;
        return $this;
    }

    /**
     * @return Ejercicio[]|Collection
     */
    public function getEjercicios()
    {
        return $this->ejercicios;
    }

    /**
     * @param Ejercicio[]|Collection $ejercicios
     * @return Aparato
     */
    public function setEjercicios($ejercicios)
    {
        $this->ejercicios = $ejercicios;
        return $this;
    }

    /**
     * @return Maquina[]|Collection
     */
    public function getMaquinas()
    {
        return $this->maquinas;
    }

    /**
     * @param Maquina[]|Collection $maquinas
     * @return Aparato
     */
    public function setMaquinas($maquinas)
    {
        $this->maquinas = $maquinas;
        return $this;
    }



}