<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table()
 */

class Reserva
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column (type="datetime")
     * @var \DateTime
     */
    private $fechaReserva;

    /**
     * @ORM\ManyToOne(targetEntity="Maquina",inversedBy="reservas")
     * @var Maquina
     */
    private $maquina;

    /**
     * @ORM\ManyToOne (targetEntity="Horario",inversedBy="reservasHora")
     * @var Horario
     */
    private $horario;

    /**
     * @ORM\ManyToOne (targetEntity="Usuario",inversedBy="reservasUsuario")
     * @var Usuario
     */
    private $usuario;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return Date
     */
    public function getFechaReserva(): ?Date
    {
        return $this->fechaReserva;
    }

    /**
     * @param Date $fechaReserva
     * @return Reserva
     */
    public function setFechaReserva(Date $fechaReserva): Reserva
    {
        $this->fechaReserva = $fechaReserva;
        return $this;
    }

    /**
     * @return Maquina
     */
    public function getMaquina(): ?Maquina
    {
        return $this->maquina;
    }

    /**
     * @param Maquina $maquina
     * @return Reserva
     */
    public function setMaquina(Maquina $maquina): Reserva
    {
        $this->maquina = $maquina;
        return $this;
    }

    /**
     * @return Horario
     */
    public function getHorario(): ?Horario
    {
        return $this->horario;
    }

    /**
     * @param Horario $horario
     * @return Reserva
     */
    public function setHorario(Horario $horario): Reserva
    {
        $this->horario = $horario;
        return $this;
    }

    /**
     * @return Usuario
     */
    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    /**
     * @param Usuario $usuario
     * @return Reserva
     */
    public function setUsuario(Usuario $usuario): Reserva
    {
        $this->usuario = $usuario;
        return $this;
    }





}