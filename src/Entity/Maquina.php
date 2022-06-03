<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Maquina
{

    public function  __construct()
    {
        $this->reservas = new ArrayCollection();

    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $numeroMaquina;

    /**
     * @ORM\ManyToOne(targetEntity="Aparato",inversedBy="maquinas")
     * @var Aparato
     */
    private $aparato;

    /**
     * @ORM\OneToMany (targetEntity="Reserva",mappedBy="maquina")
     * @var Reserva[]|Collection
     */
    private $reservas;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Maquina
     */
    public function setId(int $id): Maquina
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumeroMaquina(): ?int
    {
        return $this->numeroMaquina;
    }

    /**
     * @param int $numeroMaquina
     * @return Maquina
     */
    public function setNumeroMaquina(int $numeroMaquina): Maquina
    {
        $this->numeroMaquina = $numeroMaquina;
        return $this;
    }

    /**
     * @return Aparato
     */
    public function getAparato(): ?Aparato
    {
        return $this->aparato;
    }

    /**
     * @param Aparato $aparato
     * @return Maquina
     */
    public function setAparato(Aparato $aparato): Maquina
    {
        $this->aparato = $aparato;
        return $this;
    }

    /**
     * @return Reserva[]|Collection
     */
    public function getReservas()
    {
        return $this->reservas;
    }

    /**
     * @param Reserva[]|Collection $reservas
     * @return Maquina
     */
    public function setReservas($reservas)
    {
        $this->reservas = $reservas;
        return $this;
    }


}