<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */


class Dia
{
    public  function __construct(){
        $this->tablas = new ArrayCollection();
        $this->ejercicios = new ArrayCollection();
    }
    public function __toString(){
        return $this->getDiaSemana();
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
     * @ORM\ManyToMany(targetEntity="Tabla", inversedBy="dias")
     * @var Tabla[]|Collection
     */
    private $tablas;

    /**
     * @ORM\ManyToMany(targetEntity="Ejercicio", inversedBy="dias")
     * @var Ejercicio[]|Collection
     */
    private $ejercicios;

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
    public function getDiaSemana(): ?string
    {
        return $this->diaSemana;
    }

    /**
     * @param string $diaSemana
     * @return Dia
     */
    public function setDiaSemana(string $diaSemana): Dia
    {
        $this->diaSemana = $diaSemana;
        return $this;
    }

    /**
     * @return Tabla[]|Collection
     */
    public function getTablas()
    {
        return $this->tablas;
    }

    /**
     * @param Tabla[]|Collection $tablas
     * @return Dia
     */
    public function setTablas($tablas)
    {
        $this->tablas = $tablas;
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
     * @return Dia
     */
    public function setEjercicios($ejercicios)
    {
        $this->ejercicios = $ejercicios;
        return $this;
    }



}