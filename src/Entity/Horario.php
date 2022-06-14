<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Horario
{
    public function  __construct()
    {
        $this->reservasHora = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getHora();
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column (type="string")
     * @var string
     */
    private $hora;

    /**
     * @ORM\OneToMany (targetEntity="Reserva",mappedBy="horario")
     * @var Reserva[]|Collection
     */
    private $reservasHora;

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
    public function getHora(): ?string
    {
        return $this->hora;
    }

    /**
     * @param string $hora
     * @return Horario
     */
    public function setHora(string $hora): Horario
    {
        $this->hora = $hora;
        return $this;
    }

    /**
     * @return Reserva[]|Collection
     */
    public function getReservasHora()
    {
        return $this->reservasHora;
    }

    /**
     * @param Reserva[]|Collection $reservasHora
     * @return Horario
     */
    public function setReservasHora($reservasHora)
    {
        $this->reservasHora = $reservasHora;
        return $this;
    }





}